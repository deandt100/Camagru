<?php
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	$adm = false;

	if ($_POST['submit'] == "OK")
	{
		if (file_exists("../private/") == false)
			mkdir("../private");
		if (file_exists("../private/passwd"))
			$users = unserialize(file_get_contents("../private/passwd"));
		if ($login == NULL || $passwd == NULL || $users[$login] != NULL)
		{
			echo "ERROR\n";
			header("Location:create.php?err=1");
		}
		else
		{
			$users[$login]['login'] = $login;
			$users[$login]['passwd'] = hash("whirlpool", $passwd);
			$users[$login]['type'] = $type;
			file_put_contents("../private/passwd", serialize($users));
			echo ("OK\n");
			if (!$adm)
				header("Location:../index_land.php");
			else
				header("Location: admin/admin.php");
		}
	}
?>