<?php
	function sendMail($username, $email)
	{
		// the message
		$uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"]), '/');
		$link = "<a href=" . $_SERVER["SERVER_NAME"] .":" . $_SERVER["SERVER_PORT"] . $uri . "/src/verify.php" . "?verif= " . hash("whirlpool", $username) . ">Click here to verify</a>";
		//$headers = "From: noreply@email.com";
		$msg = "Thank you, " . $username . ", for registering to pp.o!\r\n\r\n" . $link;
		//$msg = "A mail";
		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		echo $email;
		// send email
		$send = mail(trim($email), "Verification", $msg);
		if ($send)
			echo "Mail sent";
		else
			echo "Failed";
		//header("Location: ../index.php");
	}
?>