<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<!-- CSS resourcen importieren für design -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-orange.min.css" />
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<link rel="stylesheet" type="text/css" href="maturcss.css">
	<meta name="theme-color" content="#3f51b5">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
	<script type="text/javascript" src="mclient.js"></script>
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
			<span class="mdl-layout-title">Maturbot</span>
			<div class="mdl-layout-spacer"></div>
			<nav class="mdl-navigation mdl-layout--large-screen-only">
				<a class="mdl-navigation__link" href="matur.php">Home</a> 
				<a class="mdl-navigation__link" href="mctrl.html">Steuerung</a> 
				<a class="mdl-navigation__link" href="mabout.html">Infos</a>
			</nav>
		</div>
	</header>
	<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Maturbot</span>
    <nav class="mdl-navigation">
	    <a class="mdl-navigation__link" href="matur.php">Home</a> 
		<a class="mdl-navigation__link" href="mctrl.html">Steuerung</a> 
		<a class="mdl-navigation__link" href="mabout.html">Infos</a>
    </nav>
  </div>
<main class="mdl-layout__content">
<div class="page-content">
<div class="mdl-grid"> <!-- Grundeinteilung 25%, 50%, 25% auf Desktop -->	
	<div class="breit">
		<div class="mdl-grid mdl-grid--no-spacing">		
			<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone"> <!-- Erste spalte auf Desktop 25% Breite, volle breite auf mobile -->				
				<div class="mdl-card mdl-shadow--2dp karte" style="margin-left:auto;margin-right:auto;"> <!-- Karte enthält erste Informationen -->					
					<div class="mdl-card__title mdl-card--expand" style="background: #3f51b5 center/cover;">			
						<h2 class="mdl-card__title-text" style="color: #fff;">Willkommen</h2>				
					</div>					
					<div class="mdl-card__supporting-text">
					<p>
						Herzlich Willkommen auf der Website zu meiner Maturaarbeit. Hier können Sie einiges über den Roboter und die Arbeit selber erfahren
						und Sie können ihn sogar selber fernsteuern.
					</p>
					</div>				
					<div class="mdl-card__actions mdl-card--border">
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="http://maturbot.ddns.net/mabout.html">Mehr Infos</a>
					</div>					
				</div>						
				<br><br>						
				<div class="mdl-card mdl-shadow--2dp karte" style="margin-left:auto;margin-right:auto;"> <!-- Karte enthält Zahlen -->	
					
					<div class="mdl-card__title mdl-card--expand" style="background: #3f51b5 center/cover;">			
						<h2 class="mdl-card__title-text" style="color: #fff;">Aufgabe</h2>				
					</div>
					
					<div class="mdl-card__supporting-text">
					<p>
						Die LEGO Minenarbeiter brauchen deine Hilfe. All ihre Transportfahrzeuge sind bei einem Felssturz zerstört worden.
						Deine Aufgabe ist es nun die Erze und Kristalle zur roten Fabrik zu befördern.
						Die Erze liegen beim Steinbruch.
						Die Kristalle kannst du im Kristalllager abholen.
					</p>
					</div>
					
					<div class="mdl-card__actions mdl-card--border">
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="http://maturbot.ddns.net/mctrl.html">Zur Steuerung</a>
					</div>
				</div>						
			</div>	
			<div class="mdl-cell mdl-cell--8-col mdl-cell--hide-phone mdl-cell--hide-tablet mdl-shadow--2dp" style="padding: 10px;"> <!-- Zweite spalte auf Desktop, unsichtbar auf mobile -->
				<h2 style="text-align: center">Liveübertragung des Roboters</h2>
				<div id="strstart" style="width: 100%; height: 700px;">
					<button id="strbtn" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="strStarten();" style="margin-left:auto;margin-right:auto;"><p>Übertragung Starten</p></button>
				</div>
				<div class="chat2" id="messages"></div>
			</div>
		</div>
	</div>
</div>
</div>
</main>
</div>
</body>
<script type="text/javascript">
	function strStarten() {	
		document.getElementById("strstart").innerHTML = "<iframe src=\"http://maturbot.ddns.net:8090/jsfs.html\" height=\"100%\" width=\"100%\" class=\"video largeStream\"></iframe><iframe src=\"http://maturbot.ddns.net:8080/jsfs.html\" height=\"100%\" width=\"100%\" class=\"video smallStream\"></iframe>";
		document.getElementById("strbtn").style.display = 'none';
		}
</script>
</html>