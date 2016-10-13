<?php
	include "../config/connect.php";

	if ($_POST["submit"] != "delete")
	{
		header("Location: ../index.php");
		return;
	}
	$pdo = connect();
	$pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("DELETE FROM images WHERE image_id = :image_id");
	$stmt->bindParam(":image_id", $_POST["image_id"]);
	$stmt->execute();
	$stmt = $pdo->prepare("DELETE FROM comments WHERE image_id = :image_id");
	$stmt->bindParam(":image_id", $_POST["image_id"]);
	$stmt->execute();
	echo "HERE";
	shell_exec("rm -f ../images/" . $_POST["image_id"]);
	header("Location: ../index.php");
	$pdo = null;
	return ;
?>