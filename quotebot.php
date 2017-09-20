<?php
//Index page as a hub
require '../backendnogit/db.php';
session_start();

// Restoring account if cookies are set
if ($_SESSION['logged_in'] != 1) {
	if (isset($_COOKIE['uhash']) and isset($_COOKIE['uid'])) { // Restorecookies are set
		
		// Check the cookies
		$uid = $_COOKIE['uid'];
		$uhash = $_COOKIE['uhash'];
		
		$sql = "SELECT * FROM users WHERE hash = '$uhash' AND id = '$uid'";
		$result = $conn->query($sql);
		
		if ( $result->num_rows == 1 ){ // Cookies are correct, log in
			$user = $result->fetch_assoc();
			$_SESSION['email'] = $user['email'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['votes'] = $user['votes'];
			$_SESSION['logged_in'] = true;
		}
	}
}

function isMobileDevice(){
	$aMobileUA = array(
			'/iphone/i' => 'iPhone',
			'/ipod/i' => 'iPod',
			'/ipad/i' => 'iPad',
			'/android/i' => 'Android',
			'/blackberry/i' => 'BlackBerry',
			'/webos/i' => 'Mobile'
	);
	
	//Return true if Mobile User Agent is detected
	foreach($aMobileUA as $sMobileKey => $sMobileOS){
		if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
			return true;
		}
	}
	//Otherwise return false..
	return false;
}


// GTFO if on desktop
if (!isMobileDevice()) {
	header("location: dquotebot.php");
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-blue.min.css" /> 

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<title>Quote-Bot</title>

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
      <span class="mdl-layout-title">Quotebot</span>
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
    <span class="mdl-layout-title">Quotebot</span>
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
		    <h2 class="mdl-card__title-text" style="color: #fff;">Quotes of the day</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
		    <?php
		
		// New random Quote every day
		// Get the quote count
		$sql = "SELECT * FROM quotes";
		$result = $conn->query($sql);
		$quote_cnt = $result->num_rows;
		// Chose a random Quote every day
		srand(date("Ymd")); // Seed the rand() function
		$wahl = rand(0, $quote_cnt);
		for ($x = 0; $x < $wahl; $x++) {
			$row = $result->fetch_assoc();
		}
		echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
		
		$row = $result->fetch_assoc();
		echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
		$row = $result->fetch_assoc();
		echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
		$row = $result->fetch_assoc();
		echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
		$row = $result->fetch_assoc();
		echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
		?>
		
		  </div>
		  <div class="mdl-card__actions mdl-card--border">
		    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/repository.php">
		      Verzeichnis
		    </a>
		  </div>
		</div>
		<br>
		
		<?php 
		
		// Preparing for statistics
		
		// Users
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);
		$user_cnt = $result->num_rows;
		
		// count quoted
		function getQuotesCount($qname) {
			require '../backendnogit/db.php';
			$sql = "SELECT * FROM quotes WHERE name='$qname'";
			$result = $conn->query($sql);
			$qrows = $result->num_rows;
			return $qrows;
		}
		
		?>
		
		<div class="mdl-card mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;">
		  <div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center / cover;">
		    <h2 class="mdl-card__title-text" style="color: #fff;">Statistiken</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
		    <p>Anzahl Quotes: <?php echo $quote_cnt;?></p>
			<p>PHP Version: <?php  echo phpversion(); ?></p>
			<p>Registrierte Nutzer: <?php echo $user_cnt;?></p>
			<p>Anzahl Seviiquotes: <?php echo getQuotesCount("Sevii");?>
			<p>>1000 Zeilen Code</p>
			<p>Current Version 1.4</p>
		  </div>
		  <div class="mdl-card__actions mdl-card--border">
		    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="https://github.com/MSthe00/Quotebot">
		      Github
		    </a>
		  </div>
		</div>
		<br>
		
		<div class="mdl-card mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;">
		  <div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center / cover;">
		    <h2 class="mdl-card__title-text" style="color: #fff;">News</h2>
		  </div>
		  <div class="mdl-card__supporting-text">
			<p>24.04.17: Votesystem ist fertig</p>
			<p>23.04.17: Beginn der Arbeit am Votesystem</p>
			<p>20.04.17: Accountsystem ist fertig</p>
			<p>18.04.17: Encodings sind scheisse</p>
		  </div>
		  <div class="mdl-card__actions mdl-card--border">
		    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/changelog.php">
		      Changelog
		    </a>
		  </div>
		</div>
		
	</div>
  </main>
</div>
</body>

</html>