<?php





session_start();
require 'Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '6410125645706362',

  'app_secret' => '5aee89322d8d7ea6ba59f2e379663148',
  'default_graph_version' => 'v13.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Add any additional permissions you need

$loginUrl = $helper->getLoginUrl('https://your-website.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';




	include("classes/connect.php");
	include("classes/login.php");

	$email = "";
	$password = "";

		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login = new Login();
		$result = $login->evaluate($_POST);

		if($result != "")
		{
			echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
			echo "<br>the following errors occured<br><br>";
			echo $result;
			echo "</div>";
		}
		else
		{

			header("Location: profile.php");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];



	}
	
?> 

<html>
<head>
	<title>Pigeon | Log in</title>


</head>

	<style>
		
		#bar1{
			height:100px;
			background-color: #405d9b;
			padding: 4px;
			
		} 

		#signup_button{
			background-color: #42b72a;
			font-size: 15px;
			width: 70px;
			text-align: center;
			padding: 4px;
			border-radius: 4px;
			float: right;
		}
		
		#bar2{
			background-color: white;
			width: 800px;
			height: auto;
			margin:auto;
			margin-top: 70px;
			padding: 10px;
			padding-top: 70px;
			text-align: center; 
			font-weight: bold;

		}

		#text{
			height: 35px;
			width: 300px;
			border-radius: 4px;
			border: solid 1px #ccc;
			padding: 4px;
			font-size: 14px;
		}

		#button{

			width: 300px;
			height: 35px;
			border-radius: 4px;
			font-weight: bold;
			border: none;
			background-color: #405d9b;
			color: white;
		}

		#owner{
			background-color: #405d9b;
			font-size: 10px;
			width: auto;
			text-align: center;
			padding: 4px;
			border-radius: 4px;
			float: left;
			color: #aaa;


		}

	</style>


  <body style="font-family: tahoma;background-color: #e9ebee;">

	<div id="bar1">
		<div style="font-size: 40px;color: white;">Pigeon</div>
		<a href="signup.php">
		<div id="signup_button">Signup</div>
		</a>
		<a href="owner.php">
		<div id="owner">Powered By Rafid & Rifaath</div>
		</a>
		<a href="login.php">Login with Facebook</a>
	</div>

	<div id="bar2">
		
		<form method="post">
			Log in to Pigeon<br><br>

			<input name="email" value="<?php echo $email ?>"type="text" id="text" placeholder="Email"><br><br>
			<input name="password" value="<?php echo $password ?>"type="Password" id="text" placeholder="Password"><br><br>
			
			<input type="submit" id="button" value="Log in">
			<br><br><br><br>

		</form>

	</div>

  </body>
</html>