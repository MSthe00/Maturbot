<?php 
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8"/>
<title>Quote-Bot</title>
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
	<li><a href="index.php" class="active">Home</a></li>
	<li><a href="input.php">Input</a></li>
	<li><a href="repository.php">Verzeichnis</a></li>
	<li style="float: right;"><a href="account.php" >Account</a></li>
</ul>

<h2>Changelog</h2>

<h3>1.2</h3>
<ol>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ol>