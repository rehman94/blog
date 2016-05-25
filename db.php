<?php namespace blog\db; //namespace in order to avoid matching name
	$config = array(
		'username' => '',
		'password' => '',
		'dbname' => 'blogs',
		'upload_path' => 'images/'
		);

	function connect($config)
	{
		//return PDO
		try{//	here \PDO exempt the namespace and state that it is not on same root
			$conn = new \PDO('mysql:host=localhost;dbname='.$config['dbname'],$config['username'],$config['password']);
			$conn -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
			return $conn;
		}

		catch(PDOException $e){
			return false;
		}
	}

	function get($table_name,$conn, $limit = 10)
	{
		try{
			$query  = "SELECT posts.id,date_format(date,'%d-%b-%y %h:%i %p') AS date,title,body,user_id,user_name FROM ";
			$query .= " $table_name INNER JOIN users ";
			$query .= " ON users.id = posts.user_id ";
			$query .= " ORDER BY posts.id DESC ";
			$query .= " LIMIT $limit ";
		$result = $conn -> query($query);
			//if table exist but no row exist the above query runs and no row is returned for this purpose we use rowCount()>0 and output no row  is available 
		return $result -> rowCount() > 0 ? $result : false; 
		}
		catch(PDOException $e){
			return false;
		}
	}
	function query($query,$binding,$conn)
	{
		//query to execute
		//bindings to bind with the query in order to avoid sql injections
		//$conn object
		try{
			$stmnt= $conn->prepare($query);
			$stmnt->execute($binding);
			return ($stmnt -> rowCount()>0) ? $stmnt : false ;
		}
		catch(PDOException $e){
			return null;
		}
	}


	function get_post_by_id($id,$conn)
	{
		$stmnt = query("SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id WHERE posts.id = :id LIMIT 1",
								 array('id' => $id),
								 $conn);
		// $result = $stmnt-> fetchAll();
		if ($stmnt) {
			return $stmnt->fetchAll();
		}
	}

	function get_comments_by_post_id($id,$conn)
	{
		$stmnt = query("SELECT users.user_name,comments.body,comments.id,date_format(comments.date,'%d-%b-%y %h:%i %p') AS date FROM comments INNER JOIN posts ON posts.id = comments.post_id INNER JOIN users ON users.id = comments.author_id WHERE posts.id = :id",
			array('id' => $id),
			$conn);
		if ($stmnt) {
			return $stmnt->fetchAll();
		}
	}

	function get_user_by_username($username,$conn,$id=null){
		
		$query = "SELECT * FROM users WHERE user_name = :username LIMIT 1";
		$stmnt  = query($query,
							array('username' => $username),
							$conn);
		//if user exist it will return data else it will return nothing
		if ($stmnt) {
			return $stmnt -> fetchAll();
		}else{
			return false;
		}
	}

	function add_comment($post_id,$author_id,$comment,$conn)	
	{
		$query = "INSERT INTO comments(post_id,author_id,body) VALUES(:post_id,:author_id,:comment)";
		$stmnt = query($query,array('post_id' => $post_id,'author_id' => $author_id,'comment' => $comment),$conn);
	}
	// function get_users_post_by_id($id,$conn)
	// {
	// 	$stmnt = query("SELECT * FROM posts WHERE user_id = :id",
	// 					array('id' => $id),
	// 					$conn);

	// 	if ($stmnt) {
	// 		return $stmnt->fetchAll();
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }
	function get_users_post_by_id($id,$conn)
	{
		try{
			$query  = "SELECT posts.id,title,body,user_id,user_name FROM ";
			$query .= " posts INNER JOIN users ";
			$query .= " ON users.id = posts.user_id "; 
			$query .= " WHERE user_id = $id ";
			$query .= " ORDER BY posts.id DESC ";
	
			$result = $conn -> query($query);
			//if table exist but no row exist the above query runs and no row is returned for this purpose we use rowCount()>0 and output no row  is available 
		return $result -> rowCount() > 0 ? $result : false; 
		}
		catch(PDOException $e){
			return false;
		}
	}
	
	function update_post($user_id,$post_id,$title,$body,$conn)
	{
		$query = "UPDATE posts SET title = :title , body = :body WHERE id= :post_id AND user_id= :user_id LIMIT 1";
		$stmnt = query($query,
							array('user_id' => $user_id, 'post_id'=> $post_id, 'title' => $title , 'body' => $body),
							$conn);
		return $stmnt;
	}

	function delete_post_by_id($user_id,$post_id,$conn)
	{
		$query = "DELETE FROM posts WHERE posts.id = :post_id AND user_id = :user_id LIMIT 1";
		$stmnt = query($query,
							array('post_id' => $post_id, 'user_id' => $user_id),
							$conn);
		return $stmnt;
	}

	function get_user_by_id($id,$conn){
		$query = "SELECT * FROM users WHERE id = :id ";
		$stmnt = query($query, array('id' => $id),$conn);
		// return $stmnt;

		if ($stmnt) {
		 	return $stmnt-> fetch();
		} else{
			return false; 	
	 	}
	}

function create_user($first_name,$last_name,$user_name,$encrypted_password,$conn){
	$query = "INSERT INTO users(first_name,last_name,user_name,encrypted_password) 
						VALUES(:first_name,:last_name,:user_name,:encrypted_password)";

	$stmnt = query($query, 
					 array('first_name' => $first_name, 'last_name' => $last_name, 'user_name' => $user_name,'encrypted_password' => $encrypted_password),
					$conn);

	return $stmnt;
}

function update_user($first_name,$last_name,$user_name,$email,$gender,$birthday_day,$birthday_month,$birthday_year,$image_name,$id,$conn){
	$query = "UPDATE users SET first_name=:first_name,last_name=:last_name,user_name=:user_name,email=:email,gender=:gender,birthday_day=:birthday_day,birthday_month=:birthday_month,birthday_year=:birthday_year,images=:image_name WHERE id =:id";
	$stmnt = query($query,
					 array('first_name'=>$first_name,'last_name'=> $last_name, 'user_name'=>$user_name, 'email'=>$email,'gender'=>$gender,'image_name' => $image_name,'birthday_day'=>$birthday_day,'birthday_month' => $birthday_month,'birthday_year' =>$birthday_year,'id'=>$id),
					 $conn);	
}
function check_username_for_edit($id,$conn){
	$query = "SELECT user_name FROM users WHERE id <> :id";
	$stmnt = query($query,array('id' => $id),$conn);
	if ($stmnt) {
		return $stmnt -> fetchAll();
	}else{
		return false;
	}
}

function change_password($id,$user_name,$new_password,$conn) {
	$query = "UPDATE users SET encrypted_password = :new_password WHERE id = :id AND user_name = :user_name";
	$stmnt = query($query,array('id'=>$id,'new_password'=>$new_password,'user_name'=>$user_name),$conn);
}

function deleteUserById($id,$conn)
{
	$query = "DELETE FROM users WHERE id = :id LIMIT 1";
	$stmnt = query($query,array('id' => $id),$conn);
}
?>