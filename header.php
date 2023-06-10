<!--top bar-->
<?php
	
	$corner_image = "images/user_male.jpg";
	if (isset($user_data))
		{
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
		}

?>
<div id="blue_bar">
	<div style="width: 800px; margin: auto; font-size: 30px;">

		<a href="index.php" style="color: white;">Pigeon</a>

		&nbsp &nbsp <input type="text" id="search_box" placeholder="Search for people">

		<a href="profile.php">
		<img src="<?php echo $corner_image ?>" style="width: 50px; float: right;">
		</a>

		<a href="logout.php">
		<span style= "font-size:11px;float: right;margin:15px;color:white;">Logout</span>
		</a>

	</div>
	
</div>