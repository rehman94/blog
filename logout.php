<?php 
	session_start();
	session_destroy();

	$_SESSION['user_name'] = array();
	unset($_SESSION);

	header("Location: login.php");

?>