<?php
	include "imageList.php";
	include "config/connect.php";

	session_start();
	$user = $_SESSION['logged_on_user'];
	$pdo = connect();
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT image_url FROM images 
							WHERE user = '" . $user . "'" .
							"ORDER BY date_created DESC");
	$stmt->execute();
	$urls = $stmt->fetchAll(PDO::FETCH_COLUMN);
	$stmt = $pdo->prepare("SELECT image_id FROM images 
							WHERE user = '" . $user . "'" 
							. "ORDER BY date_created DESC");
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
	$pdo = null;
	imageList("", $urls, $ids, "fs_img", "filmstrip_img");
?>