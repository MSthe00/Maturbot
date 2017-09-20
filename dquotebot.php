<?php 
	// A Desktop only page for almost everything
	require '../backendnogit/db.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quotebot</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-blue.min.css" /> 
	
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	
	<style type="text/css">
	
		<?php 
			if($_SESSION["logged_in"] !=1 ){ // User not logged in
				
				echo ".vtebtn { display: none; }";
				
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

	
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-desktop-drawer-button">
	<header class="mdl-layout__header">
		<div class="mdl-layout__header-row">
			<!-- Title -->
			<span class="mdl-layout-title">Quotebot</span>
			<!-- Add spacer, to align navigation to the right -->
			<div class="mdl-layout-spacer"></div>
			<!-- Navigation. We hide it in small screens. -->
			<nav class="mdl-navigation mdl-layout--large-screen-only">
				<a class="mdl-navigation__link" href="quotebot.php">Home</a> 
				<a class="mdl-navigation__link" href="repository.php">Verzeichnis</a>
				<a class="mdl-navigation__link" href="account.php">Account</a>
			</nav>
		</div>
	</header>

<main class="mdl-layout__content">

<div class="page-content">

	<br>
	<div style="width: 340px; float: left;">
    	
	    		
			
			
		<?php 
		
		// Preparing for statistics
		
		// Users
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);
		$user_cnt = $result->num_rows;
		
		// count quoted
		function getQuotesCount($qname) {
			require '../backendnogit/db.php';
			$sql = "SELECT * FROM quotes WHERE name='$qname'";
			$result = $conn->query($sql);
			$qrows = $result->num_rows;
			return $qrows;
		}
		
		require '../backendnogit/db.php';
		// New random Quote every day
		// Get the quote count
		$sql = "SELECT * FROM quotes";
		$result = $conn->query($sql);
		$quote_cnt = $result->num_rows;
		
		?>
		
		<div class="mdl-card mdl-shadow--2dp" style="float: right;">
		
			<div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center/cover;">
				<h2 class="mdl-card__title-text" style="color: #fff;">Statistiken</h2>
			</div>
			
			<div class="mdl-card__supporting-text">
				<p>Anzahl Quotes: <?php echo $quote_cnt;?></p>
				<p>PHP Version: <?php  echo phpversion(); ?></p>
				<p>Registrierte Nutzer: <?php echo $user_cnt;?></p>
				<p>Anzahl Seviiquotes: <?php echo getQuotesCount("Sevii");?>				
				<p>>1000 Zeilen Code</p>
				<p>Current Version 1.4</p>
			</div>
			
			<div class="mdl-card__actions mdl-card--border">
				<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="https://github.com/MSthe00/Quotebot"> Github </a>
			</div>
			
		</div>
		
		
		<br style="clear: both" />
		<br style="clear: both" />


		<div class="mdl-card mdl-shadow--2dp" style="float: right;">
		
			<div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center/cover;">
				<h2 class="mdl-card__title-text" style="color: #fff;">News</h2>
			</div>
			
			<div class="mdl-card__supporting-text">
				<p>30.08.17: Material Design und neue Homepage</p>
				<p>24.04.17: Votesystem ist fertig</p>
				<p>23.04.17: Beginn der Arbeit am Votesystem</p>
				<p>20.04.17: Accountsystem ist fertig</p>
				<p>18.04.17: Encodings sind scheisse</p>
			</div>
			
			<div class="mdl-card__actions mdl-card--border">
				<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/changelog.php"> Changelog </a>
			</div>
			
		</div>
	</div>



	<!-- Second collum with table -->
	<div style="width: calc(100% - 680px); float: left;">
		<div class="table-responsive">
			<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="margin-left: auto; margin-right: auto;">
				<thead>
					<tr>
						<th class="mdl-layout--large-screen-only" style="padding-left: 30px;"></th>
						<th class="mdl-data-table__cell--non-numeric">Name</th>
						<th>Jahr</th>
						<th class="mdl-data-table__cell--non-numeric">Quote</th>
						<th class="mdl-layout--large-screen-only">Votes</th>
						<th class="mdl-layout--large-screen-only vtebtn"></th>
						<th class="mdl-layout--large-screen-only vtebtn"></th>
					</tr>
				</thead>
				
			<?php 
			
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			$sql = "SELECT * FROM quotes ORDER BY id DESC";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				// output data of each row
				for($x=0; $x<=11; $x++) {// up and downvotes get a different link
					$row = $result->fetch_assoc();
					$uv = "<a class=\"u".$row['id']." mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect vtebtn\" 
					href=./scripts/qbphp/voter.php?id=".$row["id"]."&vtype=up onclick=\"keepScroll();\">Upvote</a>";
					
					$dv = "<a class=\"d".$row['id']." mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect vtebtn\" 
					href=./scripts/qbphp/voter.php?id=".$row["id"]."&vtype=down onclick=\"keepScroll();\">Downvote</a>";
					$idRow = "<td hidden>".$row['id']."</td>";
					
					if ($row["w"]==1) { // Literal quote
						echo "<tr><td class=\"mdl-layout--large-screen-only\"style=\"padding: 0px;\">"."<img src=\"felixverdruckt.png\" height=\"40px\" width=\"40px\">".
						"</td><td class=\"mdl-data-table__cell--non-numeric\">" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td class=\"mdl-data-table__cell--non-numeric\">" .  $row["quote"]. "</td><td class=\"mdl-layout--large-screen-only\">".$row['votes'].
						"</td>".$idRow."<td class=\"mdl-layout--large-screen-only\">".$uv."</td><td class=\"mdl-layout--large-screen-only\">".$dv."</td></tr>
						";
					}
					else {
						echo "<tr><td class=\"mdl-layout--large-screen-only\">"."🅱️". "</td><td class=\"mdl-data-table__cell--non-numeric\">" . $row["name"]. "</td><td>" . $row["jahr"] . "</td><td class=\"mdl-data-table__cell--non-numeric\">" .  $row["quote"].
						"</td><td class=\"mdl-layout--large-screen-only\">".$row['votes']."</td>".$idRow."<td class=\"mdl-layout--large-screen-only\">".$uv."</td><td class=\"mdl-layout--large-screen-only\">".$dv."</td></tr>
						";
					}
				}
			} else {
				echo "0 results";
			}
			$conn->close();
		
			?>
			
			</table>
		</div>
	</div>


	<!-- Third collum with QOTD and Input-->
	<div style="width: 340px; float: right;">
	
		<div class="mdl-card mdl-shadow--2dp" style="float: left;">
		
			<div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center/cover;">
				<h2 class="mdl-card__title-text" style="color: #fff;">Quotes of the day</h2>
			</div>
			
			<div class="mdl-card__supporting-text">
				<?php
					require '../backendnogit/db.php';
					// New random Quote every day
					// Get the quote count
					$sql = "SELECT * FROM quotes";
					$result = $conn->query($sql);
					$quote_cnt = $result->num_rows;
					// Chose a random Quote every day
					srand(date("Ymd")); // Seed the rand() function
					$wahl = rand(0, $quote_cnt-5);
					for ($x = 0; $x < $wahl; $x++) {
						$row = $result->fetch_assoc();
					}
					echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
					
					$row = $result->fetch_assoc();
					echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
					$row = $result->fetch_assoc();
					echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
					$row = $result->fetch_assoc();
					echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
					$row = $result->fetch_assoc();
					echo $row["name"]." ". $row["jahr"]." - ". $row["quote"]."<br>";
				?>
	
	  		</div>
	  		
			<div class="mdl-card__actions mdl-card--border">
				<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/repository.php"> Verzeichnis </a>
			</div>
			
		</div>


		<br style="clear: both" />
		<br style="clear: both" />
		
		
		<div class="mdl-card mdl-shadow--2dp" style="float: left;">
		
			<div class="mdl-card__title mdl-card--expand" style="background: #ff5722 center/cover;">
				<h2 class="mdl-card__title-text" style="color: #fff;">Quote hinzufügen</h2>
			</div>
			
			<div class="mdl-card__supporting-text">
			
				<form action="./scripts/qbphp/processor.php" method="post">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					
						<input list="names" name="qname" autocomplete="on" maxlength="10" required class="mdl-textfield__input">
						
						<datalist id="names">
							<option value="Sevii">
							<option value="Felix">
							<option value="Väle">
							<option value="Marco">
							<option value="Lehrer">
						</datalist>
						
						<label class="mdl-textfield__label">Name</label>
						
					</div>


					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input type="number" name="jahr" autocomplete="off" value="2017" required class="mdl-textfield__input">
						<label class="mdl-textfield__label">Jahr</label>
					</div>


					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<textarea name="quote" rows="10" cols="22" maxlength="140" required class="mdl-textfield__input"></textarea>
						<label class="mdl-textfield__label">Quote</label>
					</div>


					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect">
						<input type="checkbox" name="ws" value="1" class="mdl-switch__input" checked>
						<span class="mdl-switch__label">wörtlich</span>
					</label>
					
					
					<br>
					<br>

					<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Quote hinzufügen</button>
					
				</form>
			</div>
		</div>
	</div>
</div>

</main>

</div>

</body>
</html>