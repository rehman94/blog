<?php 

	include 'db.php';
	include 'functions.php';
	$conn = blog\db\connect($config);

	if (!$conn) {
		echo "ERROR" .die();
	}
	
?>