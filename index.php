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
  $response = $fb->get('/me?fields=id,name', '{access-token}');
} catch(Facebook\Exception\ResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exception\SDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
// OR
// echo 'Name: ' . $user->getName();
	
	include("classes/autoload.php");


	$login = new Login();
	$user_data = $login->check_login($_SESSION['pigeon_userid']);


?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Timeline | Pigeon</title>
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

			min-height: 400px;
			margin-top: 20px;
			padding: 8px;
			text-align: center;
			font-size: 20px;
			color: #405d9b;

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

			


			<!--below cover area-->
			<div style="display: flex;">

				<!--friends area-->
				<div style="min-height: 400px;flex: 1;">

					<div id="friends_bar">

						<img src="selfie.jpg" id="profile_pic"><br>
						
						<a href="profile.php" style="text-decoration: none;">
						 <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
						</a>
						<a href="login.php">Login with Facebook</a>

						


					</div>
					
				</div>


				<!--posts area-->
				<div style="min-height: 400px;flex: 2.5;padding: 20px;padding-right: 0px;">
					
					<div style="border: solid thin #aaa; padding: 10px;background-color: white; ">
						<textarea placeholder="What's on your mind?"></textarea>
						<input id="post_button" type="submit" value="Post">
						<br>
						
					</div>
					<!--posts-->
					<div id="post_bar">

						<!--posts 1-->
						<div id="post">
							<div>
								<img src="user1.jpg" style="width: 75px; margin-right: 4px;">
							</div>
							<div>
								<div style="font-weight: bold;color: #405d9b">First Guy</div>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								<br/><br/>
								<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">April 23 2020</span>
							</div>
						</div>
						

						<!--posts 2-->
						<div id="post">
							<div>
								<img src="user4.jpg" style="width: 75px; margin-right: 4px;">
							</div>
							<div>
								<div style="font-weight: bold;color: #405d9b">African Dude</div>
								It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
								<br/><br/>
								<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">April 23 2020</span>
							</div>
						</div>
						

						

					</div>

				</div>
			</div>

		</div>



	</body>
</html>