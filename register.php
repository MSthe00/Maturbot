<?php
require 'db.php';
session_start();
echo "Sie stecken im Registrierungsvorgang. De Marco het öppis versaut.";
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
if ($_POST['password'] != $_POST['password2']) {
	$_SESSION['message'] = 'Die Passwörter stimmen nicht überein!';
	header("location: error.php");
}
// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['username'] = $_POST['username'];
// Escape all $_POST variables to protect against SQL injections
$username = $conn->escape_string($_POST['username']);
$email = $conn->escape_string($_POST['email']);
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);

echo "pwdone <br>";
$hash = $conn->escape_string( md5( rand(0,1000) ) );
echo "test4";
// Check if user with that email already exists
$result = $conn->query("SELECT * FROM users WHERE username='$username'") or die($conn->error());
echo "test1";
// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    echo "test1";
    $_SESSION['message'] = 'Ein Nutzer für diesen Username existiert bereits!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...
	echo "test2";
    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (username, email, password, hash) " 
            . "VALUES ('$username','$email','$password', '$hash')";

    // Add user to the database
    if ( $conn->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Eine Bestätigungsmail wurde an $email verschickt. Bitte verifiziere deinen Account mithilfe des Links in der Email.";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Quotebot Account Verifizierung';
        $message_body = '
        Hallo '.$username.',

        Danke für deine Registrierung.

        Mithilfe des folgenden Links kannst du deinen Account verifizieren:

        http://quotebot.ddnsking.com/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );
        
        
        $sql = "SELECT * FROM users WHERE username='$username'";
        if ($_POST['stayin'] == 1) {
	        if ($result= $conn->query($sql) ){
		        $row = $result->fetch_assoc();
		        setcookie("uid", $row['id'], time() + (60*60*24*365), "/");
		        setcookie("uhash", $row['hash'], time() + (60*60*24*365), "/");
	        }
	        else {
	        	$_SESSION['message'] = 'Registrierung erfolgreich. Die cookies um angemeldet zu bleiben konnten jedoch nicht gesetzt werden.';
	        	header("location: error.php");
	        }
        }
        
        
        
        header("location: profile.php"); 
		
    }

    else {
        $_SESSION['message'] = 'Registrierung fehlgeschlagen. Die Werte konnten nicht in die Datenbank aufgenommen werden.';
        header("location: error.php");
    }

}
?>
</body>

</html>