<?php 
	session_start();
	require 'blogs.php'; //blog file contains the function fil
	//connect to database
	use  blog\db;


	//fetch data fromdatabase
	$posts = db\get('posts',$conn,30);
	$title = "Blogs";

	view('index',array(
				'posts' => $posts,
				'title' => $title
		));
?>