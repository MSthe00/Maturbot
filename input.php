<?php 
// Take new Quotes and send them to processor.php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Input</title>
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


<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-desktop-drawer-button">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Input</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="quotebot.php">Home</a>
      <a class="mdl-navigation__link" href="input.php">Input</a>
      <a class="mdl-navigation__link" href="repository.php">Verzeichnis</a>
      <a class="mdl-navigation__link" href="account.php">Account</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Input</span>
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
		
		
		<?php if($_SESSION["logged_in"] !=1 ){ // Users that arent logged in get a warning since this page is useless to them
			echo "<h1 style=\"color:red\">Warnung, sie sind nicht angemeldet und können somit keine Quotes eintragen</h1>";
		}
			?>
		<div class="mdl-card mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;">
		  <div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center / cover;">
		    <h2 class="mdl-card__title-text" style="color: #fff;">Quote hinzufügen</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
		  
		<form action="./scripts/qbphp/processor.php" method="post">
		
		
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input list="names" name="qname" autocomplete="on" maxlength="10" required class="mdl-textfield__input">
			  <datalist id="names">
			    <option value="Sevii">
			    <option value="Felix">
			    <option value="Väle">
			    <option value="Marco">
			    <option value="Max">
			    <option value="Lehrer">
			  </datalist>
			  <label class="mdl-textfield__label">Name</label>
		  </div>
		 
		  
		  
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input type="number" name="jahr" autocomplete="off" value="2017" required class="mdl-textfield__input">
			<label class="mdl-textfield__label">Jahr</label>
		</div>
		
		
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<textarea name="quote" rows="10" cols="22" maxlength="140" required class="mdl-textfield__input"></textarea>
			<label class="mdl-textfield__label">Quote</label>
		</div>
		 
		<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect">
			<input type="checkbox" name="ws" value="1" class="mdl-switch__input" checked>
			<span class="mdl-switch__label">wörtlich</span>
		</label><br><br>
		 
		<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Quote hinzufügen</button>
		</form>
	  </div>
	  </div>
	  </div>
	  
	</main>
</div>



</body>
</html>