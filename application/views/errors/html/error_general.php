<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Error</title>
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="jumbotron mt-3">
	        <h1><?php echo $heading; ?></h1>
	        <p class="lead"><?php echo $message; ?></p>
	        <a class="btn btn-lg btn-primary" href="/" role="button">Home »</a>
	    </div>
	</div>
</body>
</html>
