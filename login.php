<?php
require 'db.php';
session_start();
echo "Sie stecken im Anmeldevorgang. De Marco het öppis versaut.";
/* User login process, checks if user exists and password is correct */
// Escape email to protect against SQL injections
$username = $conn->escape_string($_POST['username']);
$result = $conn->query("SELECT * FROM users WHERE username='$username'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Es existiert kein Nutzer mit diesem Username!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['votes'] = $user['votes'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        
        $sql = "SELECT * FROM users WHERE username='$username'";
        if ($_POST['stayin'] == 1) {
        	if ($result= $conn->query($sql) ){
        		
        		$row = $result->fetch_assoc();
        		setcookie("uid", $row['id'], time() + (60*60*24*365), "/");
        		setcookie("uhash", $row['hash'], time() + (60*60*24*365), "/");
        	}
        	else {
        		$_SESSION['message'] = 'Anmeldung erfolgreich. Die Cookies um angemeldet zu bleiben konnten jedoch nicht gesetzt werden.';
        		header("location: error.php");
        	}
        }
        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "Falsches Passwort! Versuche es nochmal";
        header("location: error.php");
    }
}

?>
</body>

</html>