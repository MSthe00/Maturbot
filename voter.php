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
			} else { //GTFO
				$_SESSION['message'] = "Sie haben die Voteverarbeitungsseite ohne benötigte Parameter besucht";
				//header("location: error.php");
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
				//header("location: repository.php");
				
			} else {
				$exvote = $result->fetch_assoc();
				if ($exvote['type'] == $vtype) { // user already voted the same way
				
					//delete row
					$sql = "DELETE FROM votes WHERE voter = '$usrn' and qid = '$qid'";
					$conn->query($sql);
					
					// removethe vote
					$bsql = "UPDATE quotes SET votes = votes - '$vtype' where id = '$qid'";
					$conn->query($bsql);
					//header("location: repository.php");
					
				} elseif ($exvote['type'] == -1*$vtype) { // user has already voted the  other way
					
					// Update his vote in the database
					$sql = "UPDATE votes SET type = '$vtype' where qid = '$qid' and voter = '$usrn'";
					
					$conn->query($sql);
					
					// Add a vote to the Quote
					$bsql = "UPDATE quotes SET votes = votes + 2*'$vtype' where id = '$qid'";
					$conn->query($bsql);
					//header("location: repository.php");
					
				}
			}
		}
} else { //User visited link a wrong way
	$_SESSION['message'] = "Sie haben die Voteverarbeitungsseite ohne benötigte Parameter besucht";
	header("location: error.php");
	
}

?>