<?php
	include "../config/connect.php";
	include "sendMail.php";

	$pdo = connect();
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :name");
    $stmt->bindParam(':name', $_POST["uname"]);
    $stmt->execute();
	if ($stmt->rowCount() > 0)
	{
		echo "Error";
		header("Location: ../registerForm.php?error=1");
		return ;
	}
	$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->execute();
	if ($stmt->rowCount() > 0)
	{
		echo "Error";
		header("Location: ../registerForm.php?error=2");
		return ;
	}
	$stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:name, :pass, :email)");
	$stmt->bindParam(':name', $_POST["uname"]);
	$stmt->bindParam(':email', $_POST["email"]);
	$stmt->bindParam(':pass', hash("whirlpool", $_POST["psw"]));
	$stmt->execute();
	$pdo = null;
	sendMail($_POST["uname"], $_POST["email"]);
?>