<?php 
// A repository with all Quotes
require '../backendnogit/db.php';
session_start();

// use votes.php if necessairy

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


<?php 
if($_SESSION["logged_in"] !=1 ){ // User not logged in
	
	$_SESSION['message'] = "Bitte logge dich ein oder registriere dich, um auf das Verzeichnis zuzugreifen";
	header("location: error.php");
	
} else { // User logged in proceed
	
	$usrn = $_SESSION['username'];

	$sql = "SELECT * FROM votes WHERE voter = '$usrn'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()) { // returns each row

		if ($row['type']==1){ // updoot
			
			echo "a.u".$row['qid'].", ";
			
		} else { //downdoot
			
			echo "a.d".$row['qid'].", ";
			
		}
	}
		echo "a.throwaway";
}
?> {
    background-color: lightgreen;
}

a:link:not(.nactive):not(.nav), a:visited:not(.nactive):not(.nav) {
    display: block;
    color: black;
    padding: 7px 8px;
    text-decoration: none;
    border-style: solid;
    border-width: 1px;
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
	<li><a href="index.php" class="nav">Home</a></li>
	<li><a href="input.php" class="nav">Input</a></li>
	<li><a href="repository.php" class="nactive">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" class="nav">Account</a></li>
</ul> <br> <br>

<table id="quotes">
	<tr>
		<th></th>
	    <th onclick="sortTable(1)">Name</th>
	    <th onclick="sortId(5)">Jahr</th> 
	    <th onclick="sortTable(3)">Quote</th>
	    <th onclick="sortTable(4)">Votes</th>
	    <th>Upvote</th>
	    <th>Downvote</th>
  	</tr>
	
	<?php 
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM quotes ORDER BY id DESC";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) { // up and downvotes get a different link
			$uv = "<a class=\"u".$row['id']."\" href=/voter.php?id=".$row["id"]."&vtype=up onclick=\"keepScroll();\">Upvote</a>";
			$dv = "<a class=\"d".$row['id']."\" href=/voter.php?id=".$row["id"]."&vtype=down onclick=\"keepScroll();\">Downvote</a>";
			$idRow = "<td style=\"display:;\">".$row['id']."</td>";
			
			if ($row["w"]==1) { // Literal quote
				echo "<tr><td style=\"padding: 0px;\">"."<img src=\"felixverdruckt.png\" height=\"40px\" width=\"40px\">".
				"</td><td>" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td>" .  $row["quote"]. "</td><td>".$row['votes'].
				"</td>".$idRow."<td>".$uv."</td><td>".$dv."</td></tr>
				";
			}
			else {
				echo "<tr><td>"."🅱️". "</td><td>" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td>" .  $row["quote"].
				"</td><td>".$row['votes']."</td>".$idRow."<td>".$uv."</td><td>".$dv."</td></tr>
				";
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();

	?>
	
</table> <br> <br>


<script type="text/javascript">

// Scroll Scripts
function keepScroll() { // save the users scroll amount
	document.cookie = "scrollPos = "+window.pageYOffset+";";
}

function restorePosition() { // restore the users scroll amount
	if (document.cookie.indexOf("scrollPos") >= 0) {
		var sPos = getCookie("scrollPos");
		window.scrollTo(0, sPos);
		document.cookie = "scrollPos=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	}
}

function getCookie(name){
    var pattern = RegExp(name + "=.[^;]*")
    matched = document.cookie.match(pattern)
    if(matched){
        var cookie = matched[0].split('=')
        return cookie[1]
    }
    return false
}

restorePosition();


// Sorting Script

function sortTable(n) { //Taken from W3schools.com
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("quotes");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function sortId(n) {//Taken from W3schools.com

  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("quotes");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

</script>


</body>
</html>