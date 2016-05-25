<?php if (isset($data['error'])): ?>
	<p id="error"><?php echo $data['error']; ?></p>
<?php endif ?>
<form action="" method="post">
	<ul>
		<li>
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="first_name" value="<?php echo old('first_name'); ?>">
		</li>
		<li>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="last_name" value="<?php echo old('last_name'); ?>">
		</li>
		<li>
			<label for="user_name">Username</label>
			<input type="text" name="user_name" id="user_name" value="<?php echo old('user_name'); ?>">
		</li>
		<li>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="confirm_password">Re Enter Password</label>
			<input type="password" name="confirm_password" id="confirm_password">
		</li>
		<li>
			<input type="submit" name="submit" value="Sign Up">
		</li>
	</ul>
</form>

<a href="login.php">Go to Home Page</a>