<?php
session_start(); 
include 'blogs.php';

// echo $_SESSION['id'];
	
	$users_post = blog\db\get_users_post_by_id($_SESSION['id'],$conn);
	$title = "Your Blogs";
view('user_blogs',array(
	'users_post' => $users_post,
	'title' => $title
	));
?>