<?php
	include "src/imageList.php";
	include "src/pageIndex.php";
	include "config/connect.php";

	$curPage =  $_GET['page'];
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
	$imgPerPage = 20;
	$pages = pageIndex(count($ids), $imgPerPage);
	if ($curPage > $pages)
		$curPage = $pages;
	if ($curPage <= 0)
		$curPage = 1;
	$ids = array_slice($ids, $imgPerPage * ($curPage - 1) , $imgPerPage);
	$urls = array_slice($urls, $imgPerPage * ($curPage - 1), $imgPerPage);
	imageList("", $urls, $ids, "preview", "hoverbox_img");
?>