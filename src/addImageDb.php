<?php
	include "../config/connect.php";

	function addImageDb($path, $name, $user)
	{
		$pdo = connect();
		
		date_default_timezone_set("Africa/Johannesburg");
		$sql = $pdo->query("USE db_camagru");
		echo "<br>name = $name path = $path";
		print_r($sql);
		$stmt = $pdo->prepare("INSERT INTO images (image_id, image_url , date_created, user) 
								VALUES (:image_id, :image_url, :date_created, :user)");
		$path = substr($path, 3);
		$stmt->bindParam(':image_id', $name);
		$stmt->bindParam(':image_url',$path);
		$date = date('Y-m-d H:i:s', time());
		$stmt->bindParam(':date_created', $date);
		$stmt->bindParam(':user', $user);
		echo print_r($stmt);
		$stmt->execute();
		$pdo = null;
	}
?>