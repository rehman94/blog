<?php 
	function view($path, $data =null){
		if ($data) {
			extract($data);
		}
		$path = $path. ".view.php";
		include 'views/layout.php';
	}

	function fieldname_as_text($value){
		return str_replace('_', ' ', $value);
	}

	function check_presences($required_fields){
		foreach ($required_fields as $field => $value) {
			if (empty($_POST[$value])){
			 $value = fieldname_as_text($value);
			 $value = ucwords($value);
			 $error[] = $value;
			}
		}
		// return $error;
		if (!empty($error)) {
			$error = error_in_one_line($error);
			return $error;
		}
	}

	function error_in_one_line($error){
		$condition = count($error)>1;
		if ($condition) {
			$last_word = array_pop($error);			
		}
		$string  = implode(', ', $error);
		if ($condition) {
			$string .= " and ". $last_word ;
		}
		$string .= " can't be blank";
		return "$string";
	}

	function old($key){
		if (isset($_REQUEST[$key])) {
			return htmlspecialchars($_REQUEST[$key]);
		}
	}

	function validate_user($users,$username,$password){
				if (($users['user_name'] == $username) && (crypt($password,$users['encrypted_password']) == $users['encrypted_password'])) {
					return true;
				}else{
					return false;
				}
	}

	function generate_salt($length=22)
	{
		//produce unique random salt
		$unique_random_string = md5(uniqid(mt_rand(),true));

		$base64_string = base64_encode($unique_random_string);

		$modified_base_string = str_replace('=', '.', $base64_string);

		$salt = substr($modified_base_string, 0,$length);

		return $salt;
	}
	
	function password_encrypt($password)
	{
		$hash_format = "$2y$10$";

		$salt = generate_salt();

		$format_and_salt = $hash_format . $salt ;
		// echo $format_and_salt . "<br>";

		$hash = crypt($password,$format_and_salt);
		// echo "$hash" . "<br>";

		// echo crypt("12345",$hash);
		// die();
		return $hash;
	}

function single_name($first_name,$last_name)
{
	return ucfirst($first_name) . " " . ucfirst($last_name);
}

function month_in_words($value)
{
	return date("M",mktime(0,0,0,$value));
}

function exist($key,$value)
{
	return htmlspecialchars($key[$value]);
}

function display_temporary($key,$status="message")
{
	if (isset($_SESSION[$key])) {
		
	$message = <<<EOT
<p id="{$status}">{$_SESSION[$key]}</p>
EOT;

	unset($_SESSION[$key]);

	return $message;

	}
}	


?>