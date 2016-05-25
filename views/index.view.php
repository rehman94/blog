
<?php echo display_temporary('status'); ?>
<?php echo display_temporary('message'); ?>

<?php if ($posts): ?>

	<?php foreach ($posts as $post): ?>

		<article>
			<h2>
				<a href="post.php?id=<?= $post['id']; ?>" >
				 	<?= $post['title']; ?> 
				</a>
			</h2>
			<span>&nbsp;&nbsp;&nbsp;by 
					<a href="view_profile.php?id=<?= $post['user_id']; ?>">
						<?= $post['user_name']; ?>
					</a>
					&nbsp;&nbsp;on
					<?= $post['date']; ?>
			</span>
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
<?php endif ?>