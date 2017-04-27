<?php
//Index page as a hub
require 'db.php';
session_start();

// Restoring account if cookies are set
if ($_SESSION['logged_in'] != 1) {
	if (isset($_COOKIE['uhash']) and isset($_COOKIE['uid'])) {
		$uid = $_COOKIE['uid'];
		$uhash = $_COOKIE['uhash'];
		$sql = "SELECT * FROM users WHERE hash = '$uhash' AND id = '$uid'";
		$result = $conn->query($sql);
		if ( $result->num_rows == 1 ){
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
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM quotes";
$result = $conn->query($sql);
$quote_cnt = $result->num_rows;
srand(date("Ymd"));
$wahl = rand(0,$quote_cnt);
for ($x = 0; $x <= $wahl; $x++) {
	$row = $result->fetch_assoc();
}
echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";


// Preparing for statistics

// Users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$user_cnt = $result->num_rows;
$conn->close();

// count quoted
function getQuotesCount(string $qname) {
	echo $qname;
	$sql = "SELECT COUNT(*) FROM quotes WHERE name = '$qname'";
	$result = $conn->query($sql);
	return $result;
}

?>


<h2>Statistiken</h2>
<p>Anzahl Quotes: <?php echo $quote_cnt;?></p>
<p>PHP Version: <?php  echo phpversion(); ?></p>
<p>Registrierte Nutzer: <?php echo $user_cnt;?></p>
<p>~800 Zeilen Code</p>
<p>Current Version 1.3</p>

<h2>News</h2>
<p>24.04.17: Votesystem ist fertig</p>
<p>23.04.17: Beginn der Arbeit am Votesystem</p>
<p>20.04.17: Accountsystem ist fertig</p>
<p>18.04.17: Encodings sind scheisse</p>
<br><br>

<p id="winfo">Mit dem weiteren Benutzen dieser Website stimmen sie zu, dass Cookies gespeichert werden.</p>
</body>

</html>