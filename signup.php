<?php 
	session_start();
	include 'blogs.php';
	$data = [];
	$title = "Sign Up for Blogs";
	$login = true;
	if (isset($_POST['submit'])) {
		//form is submitted
	 	$first_name 			=	ucfirst($_POST['first_name']);
		$last_name				= ucfirst($_POST['last_name']);
		$user_name 				= strtolower($_POST['user_name']);
		$password 				= $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$presence = check_presences(array('first_name','last_name','user_name','password','confirm_password'));

		if ($presence) {
			$data['error'] = $presence;
		}else{
			//no errorin validation
			//check the username available in the database
			if (blog\db\get_user_by_username($user_name,$conn)) {
				$data['error'] = 'username is already taken try another one';
			}else{
				//username is available
				//check the enter password should be matching
				if ($password !== $confirm_password) {
					$data['error'] = 'password should be match';
				}else{
					//go head and write values in database
					$encrypted_password = password_encrypt($password);
					blog\db\create_user($first_name,$last_name,$user_name,$encrypted_password,$conn);
					$_SESSION['message'] = "Congratulations! You have successfully created account<br> Enter username and password to login";
					header("Location: login.php");
				}
			}
			// make function of check_username($username)
			

			//check the two passwords that they are matching 
			//make function for checking the password
			
			//if all no error exist then go and create account in the database


		}

	}else{
		//it is not a post request or form is not submitted
	}
	view('views/signup',array('data' => $data, 'title' => $title,'login' => $login ));

?>
