<?php
	include "src/imageList.php";
	include "config/connect.php";

	$pdo = connect();
	$sql = $pdo->query("USE db_camagru");
	$stmt = $pdo->prepare("SELECT image_url FROM images 
							ORDER BY date_created DESC");
	$stmt->execute();
	$urls = $stmt->fetchAll(PDO::FETCH_COLUMN);
	$stmt = $pdo->prepare("SELECT image_id FROM images 
							ORDER BY date_created DESC");
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
	$pdo = null;
	imageList("", $urls, $ids, "preview");
?>