<?php
	require("../functions.php");
	require("../database.php");
	const BASE_PATH = __DIR__ . '/../';
	session_start();
	
	$_SESSION["user"] = null;
	session_destroy();
	
	$params = session_get_cookie_params();
	
	setcookie(session_name(), '', time()-3600);
	
	header('location: /sample-php-project/auth/login.php');
	
	exit();
?>

