<?php
// Displays all error messages
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Error</title>
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


<ul>
	<li><a href="index.php" class="nav">Home</a></li>
	<li><a href="input.php" class="nav">Input</a></li>
	<li><a href="repository.php" class="nav">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" class="nav">Account</a></li>
</ul> <br>


<h1>Error</h1>
<p>
<?php // Print the error message if there is one
if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
    echo $_SESSION['message'];    
else:
    header( "location: index.php" );
endif;
?>
</p> 
     
</body>
</html>