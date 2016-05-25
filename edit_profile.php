<?php 
include 'blogs.php';
session_start();
$data ='';
$title = "Edit Profile";
if (!isset($_SESSION['id'])) {
	header('Location: iindex.php');
}

$id =(int) $_SESSION['id'];
$user = blog\db\get_user_by_id($id,$conn);

if (isset($_POST['submit'])) {
	$first_name = ucfirst($_POST['first_name']);
	$last_name = ucfirst($_POST['last_name']);
	$user_name = strtolower($_POST['user_name']);
	$email = $_POST['email'];
	$gender = isset($_POST['gender']) ? (int) $_POST['gender'] : "";
	$birthday_day = (int) $_POST['birthday_day'];
	$birthday_month = (int) $_POST['birthday_month'];
	$birthday_year = (int) $_POST['birthday_year'];
	$image_name = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$image_type = $_FILES['image']['type'];

	$presence = check_presences(array('first_name','last_name','user_name'));

	if (empty($presence)) {
		//write values in database
		//check change username exist in data base or not
		$usernames = blog\db\check_username_for_edit((int)$_SESSION['id'],$conn);
		foreach ($usernames as $username) {
			if ($username['user_name'] == $user_name) {
				$data['error'] = "Username already exist";		
			}
		}
		if (empty($data)) {
			$_SESSION['user_name'] = $user_name;
			if ($_FILES['image']['error'] == 0) {
				$target = $config['upload_path'] . $image_name;
			
				if (move_uploaded_file($image_tmp, $target)) {
					$update = blog\db\update_user($first_name,$last_name,$user_name,$email,$gender,$birthday_day,$birthday_month,$birthday_year,$image_name,(int) $_SESSION['id'],$conn);
					$_SESSION['message'] = "Your profile has been updated";
					header("Location: iindex.php");	
				}

			}else{
					$update = blog\db\update_user($first_name,$last_name,$user_name,$email,$gender,$birthday_day,$birthday_month,$birthday_year,$image_name,(int) $_SESSION['id'],$conn);
					$_SESSION['message'] = "Your profile has been updated";
					header("Location: iindex.php");	
			}
			
		}
	}
	$data['error'] = $presence;
}

view('edit_profile',array(
	'user'=>$user,'data' => $data,'title' => $title));
?>