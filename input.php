<?php 
// Take new Quotes and send them to processor.php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Input</title>
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
	<li><a href="index.php">Home</a></li>
	<li><a href="input.php" class="active">Input</a></li>
	<li><a href="repository.php">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" >Account</a></li>
</ul>


<?php if($_SESSION["logged_in"] !=1 ){
	echo "<h1 style=\"color:red\">Warnung, sie sind nicht angemeldet</h1>";
}
	?>
	
	
<h2>Input Fenster</h2>

<form action="processor.php" method="post">

<p>Name:<p>
<input list="names" name="qname" autocomplete="on" maxlength="10" autofocus required>
  <datalist id="names">
    <option value="Sevii">
    <option value="Felix">
    <option value="Väle">
    <option value="Marco">
    <option value="Max">
    <option value="Lehrer">
  </datalist>
  
<p>Jahr:</p>
<input type="number" name="jahr" autocomplete="off" value="2017" required>

<p>Quote:</p>
<textarea name="quote" rows="10" cols="22" maxlength="140" required></textarea><br>

<input type="radio" name="ws" value="1" checked>Wörtlich<br>
<input type="radio" name="ws" value="0">Sinngemäss<br><br>
 
<button type="submit">Quote hinzufügen</button>
</form> <br> <br>


</body>
</html>