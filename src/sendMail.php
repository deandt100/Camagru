<?php
	function sendMail($username, $email)
	{
		$uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], '/', 1));
		$link = '<a href="http://' . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . $uri . "/src/verify.php" . "?verif=" . hash("whirlpool", $username) . '">Click here to verify</a>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$msg = "<html>
			<body>
			<p>Thank you, " . $username . ", for registering to pp.o!<br><br>" .
			$link . "</p>
			</body>
			</html>";
		echo $link;
		$msg = wordwrap($msg,70);
		$send = mail($email, "Verification", $msg, $headers);
		if ($send)
			echo "Mail sent";
		else
			echo "Failed";
		header("Location: ../index.php?success=1");
	}
?>