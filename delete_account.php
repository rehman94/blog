<?php 
include 'blogs.php';
session_start();
$title= "Delete Account";
$data = '';
if (!$_SESSION['id']) {
	header('Location: iindex.php');
}

if (isset($_POST['submit'])) {
	$password = $_POST['password'];
	// $presence = check_presences(array('password'));
	if (!empty($password)) {
		$user = blog\db\get_user_by_id((int) $_SESSION['id'],$conn);

		if(validate_user($user,$_SESSION['user_name'],$password)){
			blog\db\deleteUserById($_SESSION['id'],$conn);
			session_destroy();
			unset($_SESSION);
			header("Location: login.php");
		}
		$data['error'] = 'Password is not correct';
	}else{
		$data['error'] = 'Password cant be blank';
	}
}

view('views/delete_account',array('title' => $title,'data' => $data));
?>