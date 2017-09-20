<?php 
// Page to sign up or log in
require '../backendnogit/db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Account</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-blue.min.css" /> 

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

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

        require './scripts/qbphp/login.php'; // redirected to login.php
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require './scripts/qbphp/register.php'; // redirected to register.php
        
    }
}

if ($_SESSION['logged_in'] == 1) { //user is logged in and gets redirected to his profile page
	header("location: profile.php");
	
}
?>


<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-desktop-drawer-button">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Account</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="quotebot.php">Home</a>
      <a class="mdl-navigation__link mdl-cell--hide-desktop" href="input.php">Input</a>
      <a class="mdl-navigation__link" href="repository.php">Verzeichnis</a>
      <a class="mdl-navigation__link" href="account.php">Account</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Account</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="quotebot.php">Home</a>
      <a class="mdl-navigation__link" href="input.php">Input</a>
      <a class="mdl-navigation__link" href="repository.php">Verzeichnis</a>
      <a class="mdl-navigation__link" href="account.php">Account</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
<br>


	<div class="mdl-card mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;">
		  <div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center / cover;">
		    <h2 class="mdl-card__title-text" style="color: #fff;">Anmelden</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
			<!-- User fills in values to sign in or register -->
			<form action="account.php" method="post">
			
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" name="username" required>
					<label class="mdl-textfield__label">Username</label>
				</div>
				
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="password" name="password" required>
					<label class="mdl-textfield__label">Passwort</label>
				</div>
				
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input class="mdl-checkbox__input" type="checkbox" name="stayin" value="1" checked>
  					<span class="mdl-checkbox__label">Angemeldet bleiben</span>
				</label>
				
				<br><br>
				
				<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name="login" />Anmelden</button>
			</form>
			</div>
			</div>
<br>



	<div class="mdl-card mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;">
		  <div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center / cover;">
		    <h2 class="mdl-card__title-text" style="color: #fff;">Registrieren</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
			<form action="account.php" method="post">
			
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" name="email" required>
					<label class="mdl-textfield__label">Email</label>
				</div>
				
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" name="username" required>
					<label class="mdl-textfield__label">Username</label>
				</div>
				
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="password" name="password" required>
					<label class="mdl-textfield__label">Passwort</label>
				</div>
				
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="password" name="password2" required>
					<label class="mdl-textfield__label">Passwort wiederholen</label>
				</div>
				
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input class="mdl-checkbox__input" type="checkbox" name="stayin" value="1" checked>
  					<span class="mdl-checkbox__label">Angemeldet bleiben</span>
				</label>
				
				<br><br>
				
				<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name="register" />Registrieren</button>
			
			</form>
			</div>
			</div>
</div>
</main>
</div>
</body>
</html>