<h2>Log In</h2>
	<p id="error">
		<?= $data['status']; ?>
	</p>
<?php echo display_temporary('message'); ?>
<form action="" method="post">
	<ul>
		<li>
			<label for="user_name">Username</label>
			<input type="text" name="user_name" id="user_name" value="<?php echo old('user_name'); ?>">	
		</li>
		<li>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</li>
			<a href="forgot_password.php">
				<label for="forgot">Forgot Password?</label>
			</a>
			<a href="signup.php">
				<label for="signup">Sign Up for new account</label>
			</a>
		<li>
			<input type="submit" name="submit" value="Log In">
		</li>
	</ul>
</form>
