<?php
	function connect()
	{
		include "database.php";

		try
		{
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		echo "Connected to database successfully\n";
		return ($pdo);
	}
?>