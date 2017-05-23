<?php
// Processing new Quotes

// WARNING: THIS CODE IS EXTREMELY BAD (oldest code on the website)! DONT DO THIS AT HOME

require '../backendnogit/db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Danke</title>
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
if ($_SESSION['logged_in'] == 1){
	
	// Worlds best HTML injection protection (not realy)
	$f = "Dein Input wurde aufgrund einer möglichen Gefahr aufgehalten. Bei Einwänden besuche die folgende Seite: <a href=\"https://www.youtube.com/watch?v=dQw4w9WgXcQ\" style=\"color: Blue\">Hilfe</a>";
	$n = $_POST["qname"];
	$j = $_POST["jahr"];
	$q = $_POST["quote"];
	$s = $_POST["ws"];
	$sub = $_SESSION['username'];
	
	// why a switch statement when you can habe 3 elseifs?
	if (strpos($n, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: error.php");	
	}
	elseif (strpos($j, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: error.php");	
	}
	elseif (strpos($q, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: error.php");	
	}
	elseif (strpos($s, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: error.php");	
	}
	else {
		
		// Insert the quote
		$sql = "INSERT INTO quotes (name, jahr, quote, w, submitter)
		VALUES ('$n', '$j', '$q', '$s', '$sub')";
		if ($conn->query($sql) === TRUE) { // connection works
			
			$_SESSION['message'] = "<p>Eingereicht von $sub </p> <p>Name: $n </p> <p>Jahr: $j </p> <p> Quote: $q </p>";
			header("location: success.php");
			
		} else { // Some magical sql error
			
			$_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
			header("location: error.php");	
			
		}
		
		$conn->close();
	}
}
else {
	
	$_SESSION['message'] = "Bitte melde dich an!";
	header("location: error.php");	
	
}
?> <br> <br>


</body>
</html>