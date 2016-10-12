<?php
	include "../config/connect.php";

	$pdo = connect();
	$pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT username, password, verified FROM users WHERE username = :username");
	$stmt->bindParam(":username", $_POST["uname"]);
	$stmt->execute();
	if ($stmt->rowCount() != 1)
	{
		header("Location: ../loginForm.php?error=1");
		return ;
	}
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row["password"] != hash("whirlpool", $_POST["psw"]))
	{
		header("Location: ../loginForm.php?error=2");
		return ;
	}
	if ($row["verified"] != "yes")
	{
		header("Location: ../loginForm.php?error=3");
		return ;
	}
	$_SESSION["logged_on_user"] = $_POST["username"];
	header("Location: ../index.php");
	return ;
?>