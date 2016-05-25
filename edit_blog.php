<?php 
require 'blogs.php';
session_start();
$title = "Edit Post";
$data = "";
if (!$_SESSION['id'] && !$_SESSION['user_name']) {
	header("Location: login.php");
}

$post = blog\db\get_post_by_id($_GET['id'],$conn)[0];

if ($_SESSION['id'] != $post['user_id'] ) {
	header("Location: user_blogs.php");
}

if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$body = $_POST['body'];

	$presence = check_presences(array('title', 'body'));

	if (empty($presence)) {
		$update = blog\db\update_post((int) $_SESSION['id'],(int) $_GET['id'],$title,$body,$conn);
		$_SESSION['status'] = 'Post is updated';
		header("Location: user_blogs.php");
	}
	$data['error'] = $presence;
}		
	view('edit_blog',array('post' => $post,'title' => $title,	'data' => $data));	
?>