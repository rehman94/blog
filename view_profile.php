<?php 
include 'blogs.php';
session_start();

if (isset($_GET['id']) && isset($_SESSION['id']) && ($_GET['id'] == $_SESSION['id'])) {
	header("Location: edit_profile.php");
}

$id = (int) $_GET['id']; 
$user = blog\db\get_user_by_id($id,$conn);
$posts = blog\db\get_users_post_by_id($id,$conn);
$title = single_name($user['first_name'],$user['last_name']) ; //for title 

if (empty($user)) {
		header("Location: iindex.php");
}
view('view_profile',array('user' => $user,'posts' =>$posts,'title' => $title));

?>