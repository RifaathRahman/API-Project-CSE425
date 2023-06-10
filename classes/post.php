<?php

class Post
{
	private $error = " ";

	public function create_post($userid, $data, $files)
	{

		if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image']))
		{
			$myimage = "";
			$has_image = 0;
			$is_cover_image = 0;
			$is_profile_image = 0;

			if(isset($data['is_profile_image']) || isset($data['is_cover_image']))
			{

				$myimage = $files;
				$has_image = 1;
				
				if(isset($data['is_cover_image']))
				{
					$is_cover_image = 1;
				}

				if(isset($data['is_profile_image']))
				{
					$is_profile_image = 1;
				}
			}else
			{

				if(!empty($files['file']['name']))
				{

					$folder = "uploads/" . $userid . "/";

						//create folder
						if(!file_exists($folder))
						{

							mkdir($folder,0777,true);
							file_put_contents($folder . "index.php", "");
						}

						$image_class = new Image();
						
						$myimage = $folder . $image_class->generate_filename(15) . ".jpg";
						move_uploaded_file($_FILES['file']['tmp_name'], $myimage);

						$image_class->resize_image($myimage,$myimage,1500,1500);

					$has_image = 1;
				}
			}

			$post = "";
			if(isset($data['post'])){

				$post = addslashes($data['post']);
			}

			$postid = $this->create_postid();

			$query = "insert into posts (userid,postid,post,image,has_image,is_profile_image,is_cover_image) values ('$userid','$postid','$post','$myimage','$has_image','$is_profile_image','$is_cover_image')";

			$DB = new Database();
			$DB->save($query);

		}else
		{
			$this->error .= "Please type something to post!<br>";
		}

		return $this->error;
	}

	public function get_posts($id)
	{

		$query = "select * from posts where userid = '$id' order by id desc limit 10";

		$DB = new Database();
		$result = $DB->read($query);

		if($result)
		{
			return $result;
		}else
		{
			return false;
		}

	}

	public function get_one_post($postid)
	{

		if(!is_numeric($postid)){

			return false;
		}

		$query = "select * from posts where postid = '$postid' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if($result)
		{
			return $result[0];
		}else
		{
			return false;
		}


	}

	public function delete_post($postid)
	{

		if(!is_numeric($postid)){

			return false;
		}

		$query = "delete from posts where postid = '$postid' limit 1";

		$DB = new Database();
		$DB->save($query);

	}

	public function i_own_post($postid,$pigeon_userid)
	{

		if(!is_numeric($postid)){

			return false;
		}

		$query = "select * from posts where postid = '$postid' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if(is_array($result)){

			if($result[0]['userid'] == $pigeon_userid){

				return true;
			}
		}

		return false;

	}

	

	private function create_postid()
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
