<?php 

	session_start();
	require 'blogs.php'; //blog file contains the function or db file
	use blog\db;
	//fetch data fromdatabase
	// $blog = db\query("SELECT * FROM posts WHERE id = :id LIMIT 1",
 //                   array('id' => $_GET['id']),
 //                   $conn);
if (isset($_POST['submit'])) {
	$post_id = (int) $_GET['id'];
	$comment = trim($_POST['comment']);
	if (!empty($comment)) {
		db\add_comment($post_id,$_SESSION['id'],$comment,$conn);
	}
}

	$blog = db\get_post_by_id( (int) $_GET['id'],$conn);
	$comments = db\get_comments_by_post_id((int) $_GET['id'],$conn);
	if ($blog) {
		$blog = $blog[0];
		$title = $blog['title'];
	}else{
		header('Location: iindex.php');
	}

	view('post',array(
				'blog' => $blog,
				'comments' => $comments,
				'title' => $title
		));

	
?>