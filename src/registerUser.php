<?php
	include "../config/connect.php";
	include "sendMail.php";

	if (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST["uname"]) || !(strlen($_POST["uname"]) >= 6 && strlen($_POST["uname"]) <= 24))
	{
		header("Location: ../registerForm.php?error=1");
		return ;
	}
	if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_POST["email"]) || ($_POST["email"] != $_POST["cemail"]))
	{
		header("Location: ../registerForm.php?error=2");
		return ;
	}
	if (strlen($_POST["psw"]) < 6 || $_POST["psw"] != $_POST["confpsw"])
	{
		header("Location: ../registerForm.php?error=3");
		return ;
	}
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