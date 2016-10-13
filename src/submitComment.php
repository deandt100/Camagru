<?php
	include "../config/connect.php";

	session_start();
	date_default_timezone_set("Africa/Johannesburg");
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
	if ($_SESSION["logged_on_user"] != $_POST["image_user"])
	{
		$stmt = $pdo->prepare("SELECT email FROM users WHERE username = :username");
		$stmt->bindParam(":username", $_POST["image_user"]);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$email = $row["email"];
		$link = $_POST["url"];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$msg = "<html>
			<body>
			<p>" . $_SESSION["logged_on_user"] . " has commented on your post!<br><br>" .
			'</p><a href="http://' . $link . '">Continue to post</a>
			</body>
			</html>';
		$msg = wordwrap($msg,70);
		$send = mail($email, "Someone commented on your post!", $msg, $headers);
	}
	$pdo = null;
	header("Location: ../imageComment.php?id=" . $_POST["image_id"]);
?>