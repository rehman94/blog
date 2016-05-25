<form action="" method="post">
<?php if (isset($data['error'])): ?>
	<p id="error"><?= $data['error'] ?></p>
<?php endif ?>
	<ul>
		<li>
			<label for="title">Title</label>
			<input type="text" name="title" id="title">
		</li>
		<li>
			<label for="body">Body</label>
			<textarea name="body" id="body"></textarea>
		</li>
		<li>
			<input type="submit" name="submit" value="Create">
		</li>
	</ul>
</form>