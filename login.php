<?php 
	session_start();
	require 'blogs.php';
	$title = "Welcome to Blogs";
	$data['status'] =null;
	$login = true;
	if (isset($_SESSION['user_name'])) {
		header('Location: iindex.php');
	}

	if (isset($_POST['submit'])) {

		//check the username and password
		$user_name = $_POST['user_name'] ;
		$password = $_POST['password'] ;
		$presence = check_presences(array('user_name','password'));

		if ($presence){
			$data['status'] = "Enter Username and Password to Log In";
		}else{
			//if username and password is not empty make a query to database 
			$users = blog\db\get_user_by_username($user_name,$conn)[0];
			//check username exist in database
			if ($users) {
				if (validate_user($users,$user_name,$password)) {
					$_SESSION['user_name'] = $users['user_name'];
					$_SESSION['id'] = $users['id'];
					header("Location: iindex.php");	
				}else{
					$data['status'] = "Password and Username does not match";
				}
			
			}else{
			$data['status'] = "Username does not exist! Sign Up to create account";
			}
		}
	}else{
	//it is not a post request set the data array to null
	$data['status'] = "";
}

	view('views/login',array('data' => $data,'title' => $title,'login' => $login ));
 ?>