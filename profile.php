

<?php



session_start();
require 'Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '6410125645706362',

  'app_secret' => '5aee89322d8d7ea6ba59f2e379663148',
  'default_graph_version' => 'v13.0',
]);

try {
  // Returns a `Facebook\Response` object
  $response = $fb->get('/me?fields=id,name,email', $_SESSION['facebook_access_token']);
} catch(Facebook\Exception\ResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exception\SDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $responseUser->getGraphUser();
print_r($user);

echo 'Name: ' . $user['name'];

$accessToken = $_SESSION['facebook_access_token'];

try {
  $response = $fb->get('/me?fields=id,name,email', $_SESSION['facebook_access_token']);
  $user = $response->getGraphUser();
  
  // Access individual fields
  $id = $user->getId();
  $name = $user->getName();
  $email = $user->getEmail();

  // Do further processing or save the user information to your app's database
  
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
  // When Facebook returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['pigeon_userid']);


							//white listing	
	if(isset($_GET['id']) && is_numeric($_GET['id'])){

		$profile = new Profile();
		$profile_data = $profile->get_profile($_GET['id']);

		if(is_array($profile_data)){
			$user_data = $profile_data[0];
		}
	}
	

	//posting starts here

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{


		$post = new Post();
		$id = $_SESSION['pigeon_userid'];
		$result = $post->create_post($id, $_POST,$_FILES);

		if($result == " ")
		{
			header("Location: profile.php");
			die;
		}else
		{

			echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
			echo "<br>the following errors occured<br><br>";
			echo $result;
			echo "</div>";
		}
		
	}

	//collect posts
	$post = new Post();
	$id = $user_data['userid'];
	
	$posts = $post->get_posts($id);

	//collect friends
	$user = new User();
	
	$friends = $user->get_friends($id);

	$image_class = new Image();


?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Profile | Pigeon</title>
	</head>


	<style type="text/css">

		#blue_bar{

			height: 50px;
			background-color: #405d9b;
			color: #d9dfeb;
		}

		#search_box{

			width: 400px;
			height: 20px;
			border-radius: 5px;
			border: none;
			padding: 4px;
			font-size: 14px;
			background-image: url(search.png);
			background-repeat: no-repeat;
			background-position: right;
		}
		
		#profile_pic{

			width: 150px;
			margin-top: -200px;
			border-radius: 50%;
			border: solid 2px white;

		}

		#menu_buttons{

			width: 100px;
			display: inline-block;
			margin: 2px;
		}

		#friends_img{

			width: 75px;
			float: left;
			margin: 8px;
		}

		#friends_bar{

			background-color: white;
			min-height: 400px;
			margin-top: 20px;
			color: #aaa;
			padding: 8px;

		}

		#friends{

			clear: both;
			font-size: 12px;
			font-weight: bold;
			color: #405d9b;
		}

		textarea{

			width: 100%;
			border: none;
			font-family: tahoma;
			font-size: 14px;
			height: 60px;


		}

		#post_button{

			float: right;
			background-color: #405d9b;
			border: none;
			color: white;
			padding: 4px;
			font-size: 14px;
			border-radius: 2px;
			width: 50px;

		}

		#post_bar{

			margin-top: 20px;
			background-color: white;
			padding: 10px;
		}

		#post{

			padding: 4px;
			font-size: 13px;
			display: flex;
			margin-bottom: 20px;
		}

	</style>
	
	<body style="font-family: tahoma; background-color: #d0d8e4">

		<br>
		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px; margin: auto; min-height: 400px;">

			<div style="background-color: white; text-align: center;color: #405d9b">
				
					<?php

						$image = "images/cover_image.jpg";
						if (file_exists($user_data['cover_image']))
						{
							$image = $image_class->get_thumb_cover($user_data['cover_image']);
						}
					?>


				<img src="<?php echo $image ?>" style="width: 100%;">

				<span style="font-size: 12px;">
					
					<?php

						$image = "images/user_male.jpg";
						if($user_data['gender'] == "Female")
						{
							$image = "images/user_female.jpg";
						}
						if(file_exists($user_data['profile_image']))
						{
							$image = $image_class->get_thumb_profile($user_data['profile_image']);
						}
					?>
					
					<img id="profile_pic" src="<?php echo $image ?>"><br/>

					<a style="text-decoration: none; color: #696969;" href="change_profile_image.php?change=profile">Change Profile Image</a> | 
					<a style="text-decoration: none; color: #696969;" href="change_profile_image.php?change=cover">Change Cover</a>
				</span>

				<br>
					<div style="font-size: 20px;"><?php echo $user_data['first_name'] . " " .$user_data['last_name'] ?></div>
				<br>

				<a href="index.php"><div id="menu_buttons">Timeline</div></a>
				<div id="menu_buttons">About</div> 
				<div id="menu_buttons">Friends</div>
				<div id="menu_buttons">Photos</div>
				<div id="menu_buttons">Settings</div>

			</div>


			<!--below cover area-->
			<div style="display: flex;">

				<!--friends area-->
				<div style="min-height: 400px;flex: 1;">

					<div id="friends_bar">

						Friends<br>
						
						<?php

							if($friends)
							{

								foreach ($friends as $FRIEND_ROW) {
									# code...

									
									include("user.php");
								}
							}


						?>					


					</div>
					
				</div>


				<!--posts area-->
				<div style="min-height: 400px;flex: 2.5;padding: 20px;padding-right: 0px;">
					
					<div style="border: solid thin #aaa; padding: 10px;background-color: white; ">

						<form method="post" enctype="multipart/form-data">

							<textarea name="post" placeholder="What's on your mind?"></textarea>
							<input type="file" name="file">
							<input id="post_button" type="submit" value="Post">
							<br>
						</form>
					</div>
					<!--posts-->
					<div id="post_bar">

						<?php

							if($posts)
							{

								foreach ($posts as $ROW) {
									# code...

									$user = new User();
									$ROW_USER = $user->get_user($ROW['userid']);
									include("post.php");
								}
							}


						?>
						
						

						

					</div>

				</div>
			</div>

		</div>



	</body>
</html>