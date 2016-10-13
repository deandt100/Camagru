<?php
	include "../config/connect.php";

	session_start();
	$user = $_SESSION['logged_on_user'];
	$image_id = $_POST['image_id'];
	$pdo = connect();
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT like_id FROM likes 
							WHERE user = :user AND image_id = :image_id");
	$stmt->bindParam(':user', $user);
	$stmt->bindParam(':image_id', $image_id);
	$stmt->execute();
	$likes = $stmt->fetchAll(PDO::FETCH_COLUMN);
	if (count($likes) > 0)
	{
		$stmt = $pdo->prepare("DELETE FROM likes 
							WHERE user = :user AND image_id = :image_id");
		$stmt->bindParam(':user', $user);
		$stmt->bindParam(':image_id', $image_id);
		$stmt->execute();
	}
	else
	{
		echo "LOL";
		$stmt = $pdo->prepare("INSERT INTO likes (like_id, image_id, user) 
							VALUES (:like_id, :image_id, :user)");
		$stmt->bindParam(':user', $user);
		$stmt->bindParam(':image_id', $image_id);
		$lid = uniqid("L-");
		$stmt->bindParam(':like_id', $lid);		
		$stmt->execute();
	}
	header("Location: ../imageComment.php?id=" . $image_id);
	$pdo = null;
?>