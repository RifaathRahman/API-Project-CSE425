<?php
	
	include("classes/connect.php");
	include("classes/signup.php");

	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$signup = new Signup();
		$result = $signup->evaluate($_POST);

		if($result != ""){
			echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
			echo "<br>the following errors occured<br><br>";
			echo $result;
			echo "</div>";
		}else
		{
			header("Location: login.php");
			die;
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];

	}
	
?> 


<html>
<head>
	<title>Pigeon | Signup</title>
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

	</style>


  <body style="font-family: tahoma;background-color: #e9ebee;">

	<div id="bar1">
		<div style="font-size: 40px;color: white;">Pigeon</div>
		<a href="login.php">
		<div id="signup_button">Log in</div>
		</a>
	</div>

	<div id="bar2">
		Sign up to Pigeon<br><br>

		<form method="post" action="">
			
		

			<input value = "<?php echo $first_name ?>" name="first_name" id="text" placeholder="First Name"><br><br>
			<input value = "<?php echo $last_name ?>" name="last_name" id="text" placeholder="Last Name"><br><br>
			
			<span style="font-weight: normal;">Gender:</span><br>
			<select id="text" name="gender">
				
				<option> <?php echo $gender ?></option>
				<option>Male</option>
				<option>Female</option>

			</select>
			<br><br>

			<input value = "<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
			

			<input name="password" type="Password" id="text" placeholder="Password"><br><br>
			<input name="password2" type="Password" id="text" placeholder="Confirm Password"><br><br>
			
			<input type="submit" id="button" value="Sign up">
			<br><br><br><br>


		</form>
	</div>

  </body>
</html>