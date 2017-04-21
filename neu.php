<!DOCTYPE html>
<?php 
require 'db.php';
session_start();
?>
<html>

<head>

<title>Quote-Bot</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<meta charset="UTF-8">
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

<ul>
	<li><a href="index.php" class="active">Home</a></li>
	<li><a href="input.php">Input</a></li>
	<li><a href="repository.php">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" >Account</a></li>
</ul> <br> <br>


<h2>Quote of the day</h2>


<?php
// Create connection
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM quotes";
$result = $conn->query($sql);
$row_cnt = $result->num_rows;
srand(date("Ymd"));
$wahl = rand(0,$row_cnt);
for ($x = 0; $x <= $wahl; $x++) {
	$row = $result->fetch_assoc();
}
echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";	
$conn->close();
?>


<h2>Statistics</h2>
<p>Number of quotes: <?php echo $row_cnt; ?> <p>


<h2>News</h2>
<p>Currently working on Accountsystem. ETA Ferie</p>
<p>Current Version 1.2.0</p>


<br><br>
<p id="winfo">By using this site you agree that we are allowed to save cookies.</p>

</body>

</html>