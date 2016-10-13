<?php
include "addImageDb.php";

function getImageName()
{
	$name = uniqid("IMG-") . ".png";
	return $name;
}

function getOverlay($over_id)
{
	switch (intval($over_id))
	{
		case 1 :
			return imagecreatefrompng("../overlay/pine_tree.png");
			break;
		case 2 :
			return imagecreatefrompng("../overlay/peepo.png");
			break;
		case 3 :
			return imagecreatefrompng("../overlay/zeal.png");
			break;
		default :
			return imagecreatefrompng("../overlay/pine_tree.png");
	}
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
{
	$cut = imagecreatetruecolor($src_w, $src_h); 
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
}

function overlayImg($dest, $src)
{
	imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, imagesx($src), imagesy($src), 100);
	return $dest;
}

function uploadUserImage($over_id, $user)
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
	$ext = strtolower(substr($name, $extpos));
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
	{
		echo "$name upload is complete";
		if ($ext == ".jpg" || $ext == ".jpeg")
			$img = imagecreatefromjpeg($path);
		else if ($ext == ".png")
			$img = imagecreatefrompng($path);
		else
			exit;
		$new = overlayImg($img, getOverlay($over_id));
		if (imagepng($new, $path) != false);
			addImageDb($path, $newName, $user);
	}
   	else
	{
		echo "move_uploaded_file function failed";
		exit;
	}
	
}

function uploadWebcamImage($over_id, $user)
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
	$path = "../images/" . $newName;
	if (move_uploaded_file($tmpLoc, $path))
	{
		echo "Image upload is complete!";
		$over = getOverlay($over_id);
		$dest = imagecreatefrompng($path);
		$new = overlayImg($dest, $over);
		imagepng($new, $path);
		if (imagepng($new, $path) != false);
			addImageDb($path, $newName, $user);
	}
   	else
	{
		echo "move_uploaded_file function failed";
		exit;
	}
}

	session_start();
	$user = $_SESSION['logged_on_user'];	
	if ($_SESSION['logged_on_user'] == "")
		exit;
	$over = $_POST['overlay'];
	if (file_exists('../images') == false)
	{
		echo "Directory not made, creating";
		mkdir('../images');
	}
	if (isset($_FILES['user']))
	{
		uploadUserImage($over, $user);	
	}
	else if (isset($_FILES['webcam']))
	{
		uploadWebcamImage($over, $user);
	}
	else
	{
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit;
	}
?>