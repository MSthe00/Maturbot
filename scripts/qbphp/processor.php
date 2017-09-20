<?php
// Processing new Quotes

// WARNING: THIS CODE IS EXTREMELY BAD (oldest code on the website)! DONT DO THIS AT HOME

require '../../../backendnogit/db.php';
session_start();

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
		header("location: http://maturbot.ddns.net/error.php");	
	}
	elseif (strpos($j, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: http://maturbot.ddns.net/error.php");	
	}
	elseif (strpos($q, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: http://maturbot.ddns.net/error.php");	
	}
	elseif (strpos($s, '<') !== false) {
		$_SESSION['message'] = $f;
		header("location: http://maturbot.ddns.net/error.php");	
	}
	else {
		
	
		// Insert the quote
		$sql = "INSERT INTO quotes (name, jahr, quote, w, submitter)
		VALUES ('$n', '$j', '$q', '$s', '$sub')";
		if ($conn->query($sql) === TRUE) { // connection works
			
			$_SESSION['message'] = "<p>Eingereicht von $sub </p> <p>Name: $n </p> <p>Jahr: $j </p> <p> Quote: $q </p>";
			header("location: http://maturbot.ddns.net/success.php");
			
		} else { // Some magical sql error
			
			$_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
			header("location: http://maturbot.ddns.net/error.php");	
			
		}
		
		$conn->close();
	}
}
else {
	
	$_SESSION['message'] = "Bitte melde dich an!";
	header("location: http://maturbot.ddns.net/error.php");	
	
}
?>