<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		<?php if (isset($title)): ?>
			<?php echo $title; ?>
		<?php endif ?>
	</title>
	<style>
		body { width: 600px; margin: auto; font-family: sans-serif;}
		h1{ margin-bottom: 1px; }
		h2{ display: inline-block; margin: 0.5em 0;  }
		h2>span {font-size: 0.7em; font-weight: normal;}
		h1>span {font-size: 0.6em; font-weight: normal;}
		form ul { padding: 0 }
		form li{ list-style: none;}
		a:visited{color: blue;}
		form a>label{cursor: pointer; margin-bottom: 1em;  }
		img{ float: right; width: 250px; height: 300px; }
		img#display{border: 1px solid black; width: 200px; height: 200px;}
		img#post{float:left; width: 150px; height: 150px;}
		div> p { font-style: italic; }
		label#gender{display: inline;}
		label {display: block;}
		form input[type="text"],form input[type="file"],form input[type="password"],form input[type="email"], form textarea{ width: 50%; margin-bottom: 1em;}
		form input[type="radio"],form select{margin-bottom: 1.2em;margin-top: 0.4em;}
		form textarea { height: 300px }
		form input{ line-height: 1.5em; }
		div#body { margin-top: 1em;  }
		p#error{ color: red;	}
		p#message {color: green;}
		div#comments{clear: both; margin-left: 2em; padding-top: 0.1em; }
		div#comments > p {margin: 0; padding-left: 0.5em;}
		div#comments > form {margin-top: 1em;}
		div#control {text-align: left;}
		footer { padding: 1em; }
		h4{ margin-bottom: 2px; }
		h4>span{font-size: 0.9em; font-weight: normal; margin-left: 2em;}
		nav {font-style: italic;}
		nav>a:first-child { margin-right: 1.5em; }
		nav>a:nth-child(n+2) {margin: 0 1.5em 0;}
		footer { clear: both; text-align: left; margin-left: 160px; }
		.comment-simplebox-renderer-collapsed-content {
    border: 1px solid #ddd;
    border-top: 1px solid #d5d5d5;
    color: #b8b8b8;
    cursor: pointer;
    margin-left: 11px;
    min-height: 35px;
    border-radius: 2px;
    padding: 8px 10px 5px;}

		/*article:first-child{margin-top: 1em;}*/
	</style>
</head>
<body>
	<?php if (isset($_SESSION['user_name'])) : ?> 
	<p>		
		<nav> 
			<a href="iindex.php">
				<?= "Home" ?>
			</a> |
			<a href="user_blogs.php">
				<?= "Your Blogs"; ?>
			</a> |
			<a href="create_blog.php">
				<?= "Create Blog"; ?>
			</a>  |
			<a href="edit_profile.php">
				<?= ucfirst($_SESSION['user_name']); ?>
			</a> |
			<a href="logout.php">
				<?= "Logout"; ?>
			</a>
		</nav>
	</p>
	<?php else: ?>
		<?php if (!isset($login)): ?>
			<p>You are not Logged In, Click here to <a href="login.php">Login</a></p>			
		<?php endif ?>
	<?php endif ?>
	<h1>
		<?php echo $title; ?>
	</h1>
	<?php include($path); ?>
</body>
</html>