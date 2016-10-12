<?php
	include "../config/connect.php";

	$pdo = connect();
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT * FROM users");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		if (hash("whirlpool", $row["username"]) == $_GET["verif"])
		{
			$stmt = $pdo->prepare("UPDATE users SET verified='yes' WHERE username=:name");
			$stmt->bindParam(":name", $row["username"]);
			$stmt->execute();
			header("Location: ../index.php");
			$pdo = null;
			return ;
		}
	}
	$pdo = null;
	header("Location: ../index.php?error=1");
	return ;
?>