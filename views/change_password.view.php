<?php if (isset($data['error'])): ?>
	<p id="error">
		<?php echo $data['error']; ?>
	</p>
<?php endif ?>
<form action="" method="post">
	<ul>
		<li>
			<label for="old_password">Old Password</label>
			<input type="password" name="old_password" id="old_password">		
		</li>
		<li>
			<label for="new_password">New Password</label>
			<input type="password" name="new_password" id="new_password">
		</li>
		<li>
			<label for="confirm_password">Confirm Password</label>
			<input type="password" name="confirm_password" id="confirm_password">		
		</li>
		<li>
			<input type="submit" name="submit" value="Change Password">			
		</li>
	</ul>
</form>