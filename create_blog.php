<?php 
	session_start();
	$title = "Create Blog";
	require 'blogs.php';
	if (!$_SESSION['id'] && !$_SESSION['user_name']) {
	header("Location: login.php");
}
	$data = [];
	if (isset($_POST['submit'])) {
		$title = $_POST['title'];
		$body = $_POST['body'];
		$id = $_SESSION['id'];

		if (empty($title) || empty($body)) {
			$data['error'] = "Please enter the title and body of the blog";
		}else{
			blog\db\query("INSERT INTO posts(title,body,user_id) VALUES(:title,:body,:id) "
					,array('title' => $title , 'body' => $body, 'id' => $id),
					$conn);

			$_SESSION['status'] = "Blog is created";
			header("Location: iindex.php");
		}

	}else{
			$data['error']= "";
		}


	view('create',array('data'=>$data,'title'=> $title))
?>