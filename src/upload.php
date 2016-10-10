<?php
	// Add user auth!
//print_r($_FILES);

	function getImageName()
	{
		$name = uniqid("IMG-") . ".png";
		//Add SQL stuff
		return $name;
	}

	function uploadUserImage()
	{
		$name = $_FILES['user']['name'];
		$tmpLoc = $_FILES['user']['tmp_name'];
		$type = $_FILES['user']['type'];
		$size = $_FILES['user']['size'];
		$err = $_FILES['user']['error'];
	
		if (empty($name))
		{
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit;
		}
		$extpos = strrpos($name, ".", 0);
		$ext = substr($name, $extpos);
		$newName = getImageName();
		$path = "../images/" . $newName;
		if ($ext != ".jpg" && $ext != ".jpeg" && $ext != ".png")
		{
			echo "ERROR: Only jpeg and png images are supported.";
			if (file_exists($tmpLoc))
				unlink($tmpLoc);
			exit;
		}
		if(move_uploaded_file($tmpLoc, $path))
			echo "$name upload is complete";
    	else
		{
			echo "move_uploaded_file function failed";
			exit;
		}
		if ($ext == ".jpg" || $ext == ".jpeg")
		{
			$img = imagecreatefromjpeg($path);
		}
		else if ($ext == ".png")
		{
			$img = imagecreatefrompng($path);
		}
	}

	function uploadWebcamImage()
	{
		$name = $_FILES['webcam']['name'];
		$tmpLoc = $_FILES['webcam']['tmp_name'];
		$type = $_FILES['webcam']['type'];
		$size = $_FILES['webcam']['size'];
		$err = $_FILES['webcam']['error'];
		if (empty($tmpLoc))
		{
			echo "ERROR: Server error uploading webcam image.";
			exit;
		}
		$newName = getImageName();
		if (move_uploaded_file($tmpLoc, "../images/" . $newName))
			echo "Image upload is complete!";
    	else
			echo "move_uploaded_file function failed";
	}

	if (file_exists('../images') == false)
	{
		echo "Directory not made, creating";
		mkdir('../images');
	}
	if (isset($_FILES['user']))
	{
		uploadUserImage();	
	}
	else if (isset($_FILES['webcam']))
	{
		uploadWebcamImage();
	}
	else
	{
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit;
	}
?>