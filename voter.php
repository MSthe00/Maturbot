<?php 
// Users vote gets processed
require 'db.php';
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
<?php if (isset($_GET[id], $_GET['vtype'])){
	
	// check if the user already voted on this
	
	
	// Add his vote to the database
	
	
	// Add a vote to the Quote
	
	
} else { //User visited link a wrong way
	$_SESSION['message'] = "Sie haben die Voteverarbeitungsseite ohne benötigte Parameter besucht";
	header("location: error.php");
	
}

?>

<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="input.php">Input</a></li>
	<li><a href="repository.php" class="active">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" >Account</a></li>
</ul>

<h1>WIP you fool</h1>
<h1>Pokemon go to the polls</h1>
<iframe width="1120" height="630" src="https://www.youtube.com/embed/vwaiyjh1dGk?autoplay=1" frameborder="0" allowfullscreen></iframe>

</body>
</html>
