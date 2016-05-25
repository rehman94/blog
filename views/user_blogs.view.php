<?php if (isset($_SESSION['status'])): ?>
	<p id="message">
		<?php echo $_SESSION['status']; ?>
		<?php unset($_SESSION['status']); ?>
	</p>
<?php endif ?>
<?php if ($users_post): ?>
	<?php foreach ($users_post as $post): ?>
		<article>
			<h2>
				<a href="post.php?id=<?= $post['id']; ?>" >
				 <?= $post['title']; ?> 
				</a>
			</h2>
			<div class="body">
				<?php if (strlen($post['body']) > 150) : ?>
					<?= substr($post['body'], 0,150) . "... "; ?><br>
					<a href="post.php?id=<?= $post['id']; ?>">Continue Reading</a>
				<?php else: ?>
					<?= $post['body'] ?>
				<?php endif ?>
			</div>
		</article>
	<?php endforeach ?>
	<?php else: ?>
		<p>You haven't created any blog</p>
		<p><a href="create_blog.php">Create blog</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="iindex.php">Go Back</a></p>
<?php endif ?>
