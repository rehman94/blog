<?php if ($blog): ?>
	
	<article>
		<div id="body">
			<img id="post" src="images/<?= (empty($blog['images'])) ? 'no_image.jpg' : $blog['images']; ?>" alt="image">
			<p>by <?= $blog['user_name']; ?></p>

			<?= $blog['body']; ?>
		</div>
		<div id="comments">
		<?php if ($comments): ?>
			
		
				<?php foreach ($comments as $comment): ?>
					<h4>
						<?= $comment['user_name']; ?>
						<span>
							<?= $comment['date']; ?>
						</span>
					</h4>
					<p>
						<?= $comment['body']; ?>
					</p>
				<?php endforeach ?>
			<?php endif ?>	
			<?php if (isset($_SESSION['user_name'])): ?>
				<form action="" method="post">
					<label for="name"><h4>
						<?= $_SESSION['user_name']; ?>
					</h4></label>
					<input type="text" name="comment" id="comment" placeholder="add comment">
					<input type="hidden" name="submit" >
				</form>
			<?php endif ?>
				
			</div>

	</article>
<?php endif ?>
<div id="control">
<?php if (isset($_SESSION['id'])): //if user is login ?>
	<?php if ($blog['user_id'] == $_SESSION['id']): ?>
		<p>
			<a href="edit_blog.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">Edit Post</a>
			&nbsp;&nbsp;&nbsp;
			<a href="delete_blog.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" onclick="return confirm('Are you sure?');">
						Delete Post
			</a>
		</p>
	<?php endif ?>	
<?php endif ?>	
</div>


<footer>
	<a href="iindex.php">
		Go to Home Page
	</a>
</footer>