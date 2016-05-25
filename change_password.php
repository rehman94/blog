<?php 
session_start();
$title = "Change Password";
if (!$_SESSION['id'] && !$_SESSION['user_name']) {
	header("Location: login.php");
}
include 'blogs.php';
$data[]='';
if (isset($_POST['submit'])) {
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	$presence = check_presences(array('old_password','new_password','confirm_password'));
	if ($presence) {
		$data['error'] = $presence;
	} else {
		//make a query to database for retrieving password
		$user = blog\db\get_user_by_id((int) $_SESSION['id'],$conn);
		if(validate_user($user,$_SESSION['user_name'],$old_password)){
			//provided password is correct
			 if ($new_password === $confirm_password) {
			 	//crypt the password and write in database
			 	$encrypted_password = password_encrypt($new_password);
			 	blog\db\change_password($_SESSION['id'],$_SESSION['user_name'],$encrypted_password,$conn);
			 	$_SESSION['status'] = "Password is changed";
			 	header("Location: edit_profile.php");
			 }else{
			 	$data['error'] = "Password should match";
			 }
		}else{
			$data['error'] = "Password is not correct";
		}

	}
}
view('change_password',array('title' => $title,'data' => $data));
?>