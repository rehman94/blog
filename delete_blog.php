<?php 
include 'blogs.php';

session_start();
if (!$_SESSION['id'] && !$_SESSION['user_name']) {
	header("Location: login.php");
}
$post = blog\db\get_post_by_id((int) $_GET['id'],$conn)[0];

if ($post['user_id'] == $_SESSION['id']) {
 	//write code for deleting
 	if (blog\db\delete_post_by_id( (int) $_SESSION['id'],(int) $_GET['id'],$conn)) {
 		$_SESSION['status'] = "Post is deleted";
 		header("Location: user_blogs.php");
 	}else{
 		$_SESSION['status'] = "Post deletion is failed";
 	}

 } else{
 	header("Location: user_blogs.php");
 }


?>