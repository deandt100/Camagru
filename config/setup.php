<?php
	include "../src/connect.php";

	$conn = connect();
	//Create database
	$query_retval = mysqli_query($conn, "DROP DATABASE IF EXISTS db_camagru");
	$query_retval = mysqli_query($conn, "CREATE DATABASE db_camagru");
	if (!$query_retval)
		die ("Error: Database could not be created" . mysql_errno() . "\n");
	echo "Database created\n";

	mysqli_select_db($conn, "db_camagru");
	//Create tables
	$query = "CREATE TABLE `users` (
		username VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		password VARCHAR( 128 ) NOT NULL,
		email VARCHAR( 128 ) NOT NULL
		)";
	$query_retval = mysqli_query($conn, $query);
	if (!$query_retval)
		die ("Error: users table could not be created" . mysql_errno() . "\n");
	echo "users table created\n";
	$query = "CREATE TABLE `images` (
		image_id VARCHAR( 12 ) NOT NULL PRIMARY KEY,
		image_url VARCHAR( 128 ) NOT NULL,
		points INT NOT NULL,
		user VARCHAR( 24 ) NOT NULL
		)";
	$query_retval = mysqli_query($conn, $query);
	if (!$query_retval)
		die ("Error: images table could not be created" . mysql_errno() . "\n");
	echo "images table created\n";
	$query = "CREATE TABLE `comments` (
		comment_id VARCHAR( 12 ) NOT NULL PRIMARY KEY,
		comment VARCHAR( 256 ) NOT NULL,
		user VARCHAR( 24 ) NOT NULL
		)";
	$query_retval = mysqli_query($conn, $query);
	if (!$query_retval)
		die ("Error: comments table could not be created" . mysql_errno() . "\n");
	echo "comments table created\n";

	//Create directories
	shell_exec("rm -rf images");
	mkdir("images", 0777);
	echo "images directory created\n";
?>