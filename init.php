<?php
	session_start();
	$encoded = NULL;
	include("tools.php");
	include("model.php");
	include("format.php");
	include("user.php");
	include("image.php");
	include("login.php");
	include('router.php');
	if($encoded)
		renderEncoded($DBH, $templateContent);
	else
		render($templateContent);
?>
