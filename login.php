<?php
// Logs the user in after he fills the form out. Redirects user to his profile or an error page
require '../backendnogit/db.php';
session_start();
echo "Sie stecken im Anmeldevorgang. De Marco het öppis versaut.";

// Escape username to protect against SQL injections
$username = $conn->escape_string($_POST['username']);
$result = $conn->query("SELECT * FROM users WHERE username='$username'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Es existiert kein Nutzer mit diesem Username!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) { //the password is correct
        
    	// Set all the session variables that other pages have some user information
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['votes'] = $user['votes'];
        $_SESSION['logged_in'] = true;
        
		// User stays logged in if he wants
        if ($_POST['stayin'] == 1) {
        	
        		setcookie("uid", $user['id'], time() + (60*60*24*365), "/");
        		setcookie("uhash", $user['hash'], time() + (60*60*24*365), "/");
        }
        header("location: profile.php");
        
    }
    else { //Incorrect password
        $_SESSION['message'] = "Falsches Passwort! Versuche es nochmal";
        header("location: error.php");
    }
}

?>
</body>

</html>