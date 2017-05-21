<?php 
// User sees his account
require '../backendnogit/db.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>

<title>Profil</title>
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

if ($_SESSION['logged_in'] != 1) { //user isn't logged in and gets redirected to log in
	header("location: account.php");
	
}

?>


<ul>
	<li><a href="index.php" class="nav">Home</a></li>
	<li><a href="input.php" class="nav">Input</a></li>
	<li><a href="repository.php" class="nav">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" class="nactive">Account</a></li>
</ul>


<h2>Mein Profil</h2>

<p>Email: <?php  echo $_SESSION['email']; ?> </p>

<p>Username: <?php echo $_SESSION['username']; ?> </p>

<p>Votes: <?php echo $_SESSION['votes']; ?> </p>
<br><br>

<a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

</body>
</html>