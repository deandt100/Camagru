<?php
	include "../config/connect.php";

	session_start();
	if ($_SESSION["logged_on_user"] == "")
	{
		header("Location: ../imageComment.php?id=" . $_POST["image_id"] . "&error=1");
		return ;
	}
	if (strlen($_POST["comment"]) > 256)
	{
		header("Location: ../imageComment.php?id=" . $_POST["image_id"] . "&error=2");
		return ;
	}
	$pdo = connect();
	$pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("INSERT INTO comments (comment_id, image_id, comment, user, date_posted)
		VALUES (:comment_id, :image_id, :comment, :user, :date_posted)");
	$stmt->bindParam(":comment_id", uniqid("CMT-"));
	$stmt->bindParam(":image_id", $_POST["image_id"]);
	$stmt->bindParam(":comment", $_POST["comment"]);
	$stmt->bindParam(":user", $_POST["user"]);
	$stmt->bindParam(":date_posted", date('Y-m-d H:i:s', time()));
	$stmt->execute();
	$pdo = null;
	header("Location: ../imageComment.php?id=" . $_POST["image_id"]);
?>