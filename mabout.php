<!DOCTYPE html>
<html>
<head>
	<title>Infos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS resourcen importieren für design -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-orange.min.css" />
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<link rel="stylesheet" type="text/css" href="maturcss.css">
	<meta name="theme-color" content="#3f51b5">	
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>	
	
</head>
<body>

<!-- Google Analytics um Informationen über die Nutzer zu sammeln -->
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
			<span class="mdl-layout-title">Infos</span>
			<div class="mdl-layout-spacer"></div>
			<nav class="mdl-navigation mdl-layout--large-screen-only">
				<a class="mdl-navigation__link" href="matur.html">Home</a> 
				<a class="mdl-navigation__link" href="mctrl.html">Steuerung</a> 
				<a class="mdl-navigation__link" href="mabout.php">Infos</a>
			</nav>
		</div>
	</header>
	<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Infos</span>
    <nav class="mdl-navigation">
	    <a class="mdl-navigation__link" href="matur.html">Home</a> 
		<a class="mdl-navigation__link" href="mctrl.html">Steuerung</a> 
		<a class="mdl-navigation__link" href="mabout.php">Infos</a>
    </nav>
  </div>
<main class="mdl-layout__content">
<div class="page-content">
<div class="mdl-grid">	
	<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-phone mdl-cell--hide-tablet"></div>
	<div class="mdl-cell mdl-cell--5-col mdl-cell--8-col-tablet mdl-cell--4-col-mobile mdl-shadow--2dp abcol"> <!-- Inhalt 2 -->
			<div style="display: inline-block"">
			<h2>Roboter</h2>
			<img src="q.jpg" style=" width: 40%; float: left; margin-right: 10px; margin-top: 5px;"/>
			<p>Der Roboter ist ein Lego EV3 Stein. Er wird jedoch nicht vom vorinstallierten Betriebssystem sondern mit <a href="http://www.ev3dev.org/">ev3dev</a> betrieben.
			Dies ermöglicht die Steuerung über das Internet. Weiter wurde der Roboter mit einer Kamera in Form eines Samsung S4 ausgerüstet. Dieses streamt mithilfe der App 
			<a href="https://play.google.com/store/apps/details?id=com.pas.webcam&hl=de">IP Webcam</a> eine Liveübertragung der Kamera. Bei jeder Bewegung vorwärts oder rückwärts, 
			ist der Roboter eine halbe Sekunde in Bewegung. Wenn der Knopf gedrückt bleibt, bewegt sich der Roboter jede Sekunde.</p>
			</div>			
			<br><br>
			<div>
			<h2>Fakten</h2>
			<p><?php 

				require '../backendnogit/db.php';
				$sql = "SELECT * FROM counter";
				$result = $conn->query($sql);
				$move_cnt = $result->num_rows;
				echo $move_cnt;
				
				?> bisherige Bewegungen</p>	
			<p>5 verwendete Programmiersprachen</p>
			<p>über 600 Zeilen Code </p>
			<p><0.5 Sekunden Verzögerung für die Steuerung</p>
			<p>87/100 bei Google Pagespeed</p>
			<p>Gesamte Website 80 kB</p>
			<p>davon 63 kB Bilder</p>
			<p>und 17 kB Code</p>
			<p>Antwortezeit des Servers unter 500 ms</p>
			<p>Über 8400 km Entfernung gesteuert</p>
			<p>Verzögerung nach Seattle: 5 sek</p>
			</div>
	</div>
	<div class="mdl-cell mdl-cell--5-col mdl-cell--8-col-tablet mdl-cell--4-col-mobile mdl-shadow--2dp abcol"> <!-- Inhalt 3 -->	
			
			<h2>Programm</h2>		
			
			<p>Zur Steuerung wurde eine vielzahl von Programmiersprachen verwendet. Zuerst wird dem Nutzer die Website in Form von HTML übertragen. 
			Die Gestaltung wird von CSS übernommen, das dem Browser genau angibt, wie er das HTML darzustellen hat. Das design folgt hierbei den Material-Richtlinien von Google. 
			Ausserdem wurde es sowohl für PCs als auch für Mobilgeräte optimiert. </p>
			<p>Für die Steuerung selbst wird im ersten Schritt Javascript verwendet. Mithilfe einer Library namens Jquery schickt der Browser eine
			Anfrage für ein PHP-Script an den Server. Dies ist der letzte Schritt der im Browser selbst stattfindet.</p>
			<p>Weiter geht es auf dem Server selbst. Das PHP-Script dient als Brücke und öffnet ein Bash-Script auf dem Raspberrypi. Dieses Bash-Script verbindet sich mit dem EV3 
			Roboter und befiehlt ihm sich zu bewegen.</p>
	</div>	
	<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-phone mdl-cell--hide-tablet"></div>
</div>
</div>
</main>
</div>
</body>