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
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8"/>
<title>Quote-Bot</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">

</head>


<body>
<!-- hello code digger. Visit http://quotebot.ddnsking.com/troll.php -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96874758-1', 'auto');
  ga('send', 'pageview');
</script>

<ul>
	<li><a href="index.php" class="nactive">Home</a></li>
	<li><a href="input.php" class="nav">Input</a></li>
	<li><a href="repository.php" class="nav">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" class="nav">Account</a></li>
</ul>


<h2>Quote of the day</h2>

<?php

// New random Quote every day

// Get the quote count
$sql = "SELECT * FROM quotes";
$result = $conn->query($sql);
$quote_cnt = $result->num_rows;

// Chose a random Quote every day
srand(date("Ymd")); // Seed the rand() function
$wahl = rand(0, $quote_cnt);
for ($x = 0; $x <= $wahl; $x++) {
	$row = $result->fetch_assoc();
}
echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";


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


<h2>Statistiken</h2>
<p>Anzahl Quotes: <?php echo $quote_cnt;?></p>
<p>PHP Version: <?php  echo phpversion(); ?></p>
<p>Registrierte Nutzer: <?php echo $user_cnt;?></p>
<p>Anzahl Seviiquotes: <?php echo getQuotesCount("Sevii");?>
<p>~800 Zeilen Code</p>
<p>Current Version 1.3</p>

<h2>News</h2>
<p>24.04.17: Votesystem ist fertig</p>
<p>23.04.17: Beginn der Arbeit am Votesystem</p>
<p>20.04.17: Accountsystem ist fertig</p>
<p>18.04.17: Encodings sind scheisse</p>

<h2>Geplante features</h2>
<p>Sortierung für Verzeichnis</p>
<p>Quiz Minigame</p>

<br><br>
<p id="winfo">Mit dem weiteren Benutzen dieser Website stimmen Sie zu, dass Cookies gespeichert werden.</p>
</body>

</html>