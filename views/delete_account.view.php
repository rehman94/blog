<?php if (isset($data['error'])): ?>
	<p id="error">
		<?= $data['error']; ?>
	</p>
<?php endif ?>
<form action="" method="post">
	<ul>
		<li>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure?');">
		</li>
	</ul>
</form>