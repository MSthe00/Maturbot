<?php 
// Page to sign up or log in
require '../backendnogit/db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Account</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">

</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96874758-1', 'auto');
  ga('send', 'pageview');
</script>


<?php 

// Users logging in or registering are redirected here
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php'; // redirected to login.php
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php'; // redirected to register.php
        
    }
}

if ($_SESSION['logged_in'] == 1) { //user is logged in and gets redirected to his profile page
	header("location: profile.php");
	
}
?>


<ul>
	<li><a href="index.php" class="nav">Home</a></li>
	<li><a href="input.php" class="nav">Input</a></li>
	<li><a href="repository.php" class="nav">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" class="nactive">Account</a></li>
</ul>

<!-- User fills in values to sign in or register -->
<h2>Anmelden</h2>
<form action="account.php" method="post">
<p>Username</p>
<input type="text" name="username" required>
<p>Passwort</p>
<input type="password" name="password" required><br><br>
<input type="checkbox" name="stayin" value="1" checked>Angemeldet bleiben<br><br>
<button type="submit" class="button button-block" name="login" />Anmelden</button>
</form> <br>


<h2>Registrieren</h2>
<form action="account.php" method="post">
<p>Email</p>
<input type="text" name="email" required>
<p>Username</p>
<input type="text" name="username" required>
<p>Passwort (hashed before saved)</p>
<input type="password" name="password" required>
<p>Passwort wiederholen</p>
<input type="password" name="password2" required><br><br>
<input type="checkbox" name="stayin" value="1" checked>Angemeldet bleiben<br><br>
<button type="submit" class="button button-block" name="register" />Registrieren</button>
</form>

</body>
</html>