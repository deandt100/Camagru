<?php
	include "../config/connect.php";

	if (strlen($_POST["psw"]) < 6 || $_POST["psw"] != $_POST["confpsw"])
	{
		header("Location: ../changePass.php?error=1");
		return ;
	}
	$pdo = connect();
	session_start();
	$_SESSION["logged_on_user"] = "";
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT * FROM users");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		if (hash("whirlpool", $row["username"]) == $_POST["user"])
		{
			$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE username=:name");
			$stmt->bindParam(":name", $row["username"]);
			$stmt->bindParam(":password", hash("whirlpool", $_POST["psw"]));
			$stmt->execute();
			header("Location: ../loginForm.php");
			$pdo = null;
			return ;
		}
	}
	$pdo = null;
	header("Location: ../index.php?error=1");
	return ;
?>