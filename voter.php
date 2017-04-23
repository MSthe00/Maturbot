<?php 
// Users vote gets processed
require 'db.php';
session_start();

?>
<?php if (isset($_GET[id], $_GET['vtype'])){ // User accesses script the intended way;
		if ($_SESSION['logged_in']==1) { // User is signed in
			// set the variables for better readability
			$usrn = $_SESSION['username'];
			$qid = $_GET[id];
			
			//only 1 or -1 since it gets checked backend
			if ($_GET['vtype']=="up") {
				$vtype = 1;
			} elseif ($_GET['vtype']=="down") {
				$vtype = -1;
			}
			
			// check if the user already voted on this
			$sql = "SELECT * FROM votes where qid = '$qid' AND voter = '$usrn'";
			$result = $conn->query($sql);
			if ($result->num_rows == 0) {
				
				// Add his vote to the database
				$sql = "INSERT INTO votes (voter, qid, type) 
				VALUES ('$usrn', '$qid', '$vtype')";
				
				$conn->query($sql);
				
				// Add a vote to the Quote
				$bsql = "UPDATE quotes SET votes = votes + '$vtype' where id = '$qid'";
				$conn->query($bsql);
				$_SESSION['message'] = "Your vote has been added";
				header("location: sucess.php");
				
			} else {
				$exvote = $result->fetch_assoc();
				if ($exvote['type'] == $vtype) { // user already voted the same way
					
					$_SESSION['message'] = "You already voted this way";
					header("location: error.php");
					
				} elseif ($exvote['type'] == -1*$vtype) { // user has already voted the  other way
					
					//delete row
					$sql = "DELETE FROM votes WHERE voter = '$usrn' and qid = '$qid'";
					$conn->query($sql);
					$_SESSION['message'] = "Your vote has been succesfully canceled";
					header("location: sucess.php");
				}
			}
		}
} else { //User visited link a wrong way
	$_SESSION['message'] = "Sie haben die Voteverarbeitungsseite ohne benötigte Parameter besucht";
	header("location: error.php");
	
}

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
