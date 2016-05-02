<?php
	session_start();
	include("tools.php");
	include("model.php");
	include("format.php");
	include("user.php");
	include("login.php");
	include('router.php');

	render($templateContent);
?>
