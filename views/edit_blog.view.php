<?php if (isset($data['error'])): ?>
	<p id="error">
		<?= $data['error']; ?>
	</p>
<?php endif ?>
<form action="" method="post">
	<ul>
		<li>
			<label for="title">Title</label>
			<input type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
		</li>
		<li>
			<label for="body">Body</label>
			<textarea name="body" id="body"><?php echo $post['body']; ?></textarea>
		</li>
		<li>
			<input type="submit" name="submit" value="Update">
		</li>
	</ul>
</form>