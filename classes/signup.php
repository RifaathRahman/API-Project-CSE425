<?php

class Signup
{
	private $error = "";

	public function evaluate($data)
	{
		foreach ($data as $key => $value) {
			if (empty($value)) {
				
				$this->error = $this->error . $key . "is empty!<br>";
			}
			if ($key == "email") /*checking if the email is correct*/
			{
				/*Regular expression -checking expression of preg_match matches the value; if not then error message is shown*/
				if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){

					$this->error = $this->error . "invalid eamil address!<br>";
				}
			    $query = "select * from users where email = '$email' limit 1 ";
 
	
		    	$DB = new Database();
		
		    	$result = $DB->read($query);

		    	if(count($result)>1)
		    	{

					$this->error = $this->error . "this email already exists!<br>";
			    }
				
			}

			if ($key == "first_name") 
			{
				/*checking if a value is a number or firstname doesnt have spaces */
				if (is_numeric($value)){

					$this->error = $this->error . "first name cant be a number!<br>";
				}

				if (strstr($value, " ")) 
				{

					$this->error = $this->error . "first name cant have spaces!<br>";
				}
				
			}

			if ($key == "last_name") 
			{
				/*checking if a value is a number*/
				if (is_numeric($value)){

					$this->error = $this->error . "!<br>";
				}
				
				if (strstr($value, " ")) {

					$this->error = $this->error . "last name cant have spaces!<br>";
				}
			}
		}


		if($this->error == "")
		{
			//no error
			$this->create_user($data);
		}
		else{
			return $this->error;
		}
	}

	public function create_user($data)
	{

		$first_name = ucfirst($data['first_name']);
		$last_name = ucfirst($data['last_name']);
		$gender = $data['gender'];
		$email = $data['email'];
		$password = $data['password'];
		
		//create this
		$url_address = strtolower($first_name) . "." . strtolower($last_name);
		$userid = $this->create_userid();


		$query = "insert into users (userid, first_name, last_name, gender, email, password, url_address) values('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";

	
		$DB = new Database();
		$DB->save($query);
	}

	private function create_userid()
	{
		$length = rand(4,19);
		$number = "";
		for ($i=0; $i < $length; $i++) { 
			# code...
			$new_rand = rand(0,9);
			$number = $number . $new_rand;
		}
		return $number;
	}
}