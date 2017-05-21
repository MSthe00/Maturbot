<?php
// Registers the user in after he fills the form out. Redirects user to his profile or an error page
require '../backendnogit/db.php';
session_start();
echo "Sie stecken im Registrierungsvorgang. De Marco het öppis versaut.";

// Repeat password check
if ($_POST['password'] != $_POST['password2']) {

	$_SESSION['message'] = 'Die Passwörter stimmen nicht überein!';
	header("location: error.php");
	
} else { // Repeated password is correct, proceed

	// Set all the session variables that other pages have some user information
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['username'] = $_POST['username'];
	
	// Escape all $_POST variables to protect against SQL injections
	$username = $conn->escape_string($_POST['username']);
	$email = $conn->escape_string($_POST['email']);
	$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
	$hash = $conn->escape_string( md5( rand(0,1000) ) );
	
	// Check if user with that username already exists
	$result = $conn->query("SELECT * FROM users WHERE username='$username'") or die($conn->error());
	
	// We know user email exists if the rows returned are more than 0
	if ( $result->num_rows > 0 ) {
		
	    $_SESSION['message'] = 'Ein Nutzer für diesen Username existiert bereits!';
	    header("location: error.php");
	}
	
	else { // Username doesn't already exist in a database, proceed
	    $sql = "INSERT INTO users (username, email, password, hash) " 
	            . "VALUES ('$username','$email','$password', '$hash')";
	
	    // Add user to the database
	    if ( $conn->query($sql) ){
	
	        $_SESSION['logged_in'] = true; // So we know the user has logged in
	      
	        // Try to send registration confirmation link (verify.php)
	        $to      = $email;
	        $subject = 'Quotebot Account Verifizierung';
	        $message_body = '
	        Hallo '.$username.',
	
	        Danke für deine Registrierung.
	
	        Mithilfe des folgenden Links kannst du deinen Account verifizieren:
	
	        http://quotebot.ddnsking.com/verify.php?email='.$email.'&hash='.$hash;  
	
	        mail( $to, $subject, $message_body );
	        
	        // User stays logged in if he wants
	        $sql = "SELECT * FROM users WHERE username='$username'";
	        if ($_POST['stayin'] == 1) {
		        if ($result= $conn->query($sql) ){
			        $row = $result->fetch_assoc();
			        setcookie("uid", $row['id'], time() + (60*60*24*365), "/");
			        setcookie("uhash", $row['hash'], time() + (60*60*24*365), "/");
		        }
	        }
	        
	        
	        
	        header("location: profile.php"); 
			
	    }
	
	    else {
	        $_SESSION['message'] = 'Registrierung fehlgeschlagen. Die Werte konnten nicht in die Datenbank aufgenommen werden.';
	        header("location: error.php");
	    }
	
	}
}
?>
</body>

</html>