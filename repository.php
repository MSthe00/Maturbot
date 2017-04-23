<?php 
// A repository with all Quotes
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8"/>
<title>Verzeichnis</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

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

<?php if($_SESSION["logged_in"] !=1 ){
	echo "<h1 style=\"color:red\">Warnung, sie sind nicht angemeldet und können somit nicht voten</h1>";
}
	?>
<h2>Verzeichnis</h2>

<table>
	<tr>
		<th></th>
	    <th>Name</th>
	    <th>Jahr</th> 
	    <th>Quote</th>
	    <th>Upgoat</th>
	    <th>Downsevii</th>
  	</tr>
	
	<?php 
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM quotes";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$uv = "<a href=/voter.php?id=".$row["id"]."&vtype=up>Upgoat</a>";
			$dv = "<a href=/voter.php?id=".$row["id"]."&vtype=down>Downsevii</a>";
			if ($row["w"]==1) {
				echo "<tr><td style=\"padding: 0px;\">"."<img src=\"felixverdruckt.png\" height=\"40px\" width=\"40px\">". "</td><td>" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td>" .  $row["quote"]. "</td><td>".$uv."</td><td>".$dv."</td></tr>";
			}
			else {
				echo "<tr><td>".$row["w"]. "</td><td>" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td>" .  $row["quote"]. "</td><td>".$uv."</td><td>".$dv."</td></tr>";
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();

	?>
	
</table> <br> <br>

<a href="/index.php">Herro</a>
</body>
</html>