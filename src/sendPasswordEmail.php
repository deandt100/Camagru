<?php
	include "../config/connect.php";

	if (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST["uname"]) || !(strlen($_POST["uname"]) >= 6 && strlen($_POST["uname"]) <= 24))
	{
		header("Location: ../changePassword.php?error=2");
		return ;
	}
	$pdo = connect();
	$username = $_POST["uname"];
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT email FROM users WHERE username = :username");
	$stmt->bindParam(":username", $username);
	$stmt->execute();
	if ($stmt->rowCount() != 1)
	{
		header("Location: ../changePassword.php?error=1");
		return ;
	}
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$email = $row["email"];
	$uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], '/', 1));
	$link = '<a href="http://' . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . $uri . "/changePass.php" . "?verif=" . hash("whirlpool", $username) . '">Click here to change your password</a>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$msg = "<html>
		<body>
		<p>" . $username . ", you have requested to change your password<br><br>" .
		$link . "</p>
		</body>
		</html>";
	$msg = wordwrap($msg,70);
	$send = mail($email, "Change password", $msg, $headers);
	if ($send)
		echo "Mail sent";
	else
		echo "Failed";
	header("Location: ../index.php");
?>