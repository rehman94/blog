<?php if (isset($data['error'])): ?>
	<p id="error"><?= $data['error']; ?></p>
<?php endif ?>	

<?= display_temporary('status') ?>

<img src="images/<?= (empty($user['images'])) ? 'no_image.jpg' : $user['images']; ?>" alt="image">
<form enctype="multipart/form-data" action="" method="post">
<ul>
	<li>
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name"  value="<?= exist($user,'first_name'); ?>">			
	</li>
	<li>
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" value="<?= exist($user,'last_name'); ?>">
	</li>

	<li>
		<label for="user_name">Username</label>
		<input type="text" name="user_name" id="user_name" value="<?= exist($user,'user_name'); ?>">
	</li>
	<li>
	<!-- echo exist($user,'first_name')  -->
		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="<?= exist($user,'email'); ?>" >
	</li>
	<li>
		<label for="gender">Gender</label>
			<label id="gender">
				<input type="radio" name="gender" value="1"<? echo exist($user,'gender')==1 ?  " checked" : ""  ?>>Male
			</label>

			<label id="gender">
				<input type="radio" name="gender" value="2"<? echo exist($user,'gender')==2 ?  " checked" : ""  ?>>Female	
			</label>
	</li>
	<li>
		<label for="birthday">Birthday</label>
   	
   	<select name="birthday_day" id="day" title="Day">
   			<option value="" selected="1">Day</option>
   		<?php for ($i=1; $i <= 31; $i++) : ?> 
   			<option value="<?= $i; ?>" <?= (exist($user,'birthday_day') == $i) ? " selected" : ""; ?>><?= $i; ?></option>
   		<?php endfor ?>
   	</select>

	  <select name="birthday_month" id="month" title="Month">
	 		<option value="" selected="1">Month</option>
		<?php for ($i=1; $i <=12 ; $i++): ?> 
			<option value="<?= $i; ?>" <?= (exist($user,'birthday_month') == $i) ? " selected" : ""; ?>><?= month_in_words($i); ?></option>
		<?php endfor ?>	 	
	  </select>

	  <select name="birthday_year" id="year" title="Year" >
   		<option value="" selected="1">Year</option>
   	<?php for ($i=date("Y"); $i >=1920 ; $i--): ?>
   		<option value="<?= $i ?>" <?= (exist($user,'birthday_year') == $i) ? " selected" : ""; ?>><?= $i ?></option>
   	<?php endfor ?>
 		</select>
	</li>
	<li>
		<label for="image">Picture</label>
		<input type="file" name="image" id="image">
	</li>
	<li>
		<input type="submit" name="submit" value="Update">
	</li>	
	
</ul>
</form>

<a href="change_password.php">Change Password</a>
&nbsp;&nbsp;&nbsp;
<a href="delete_account.php">Delete Account</a>