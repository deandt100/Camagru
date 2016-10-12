<?php

	function imageList($urls, $id, $liClass)
	{
		echo "<ul class='hoverbox'>";
		$count = count($id);
		for($i = 0 ; $i < $count; $i++)
		{
			echo "
			<li>
				<a href='imageComment.php?id=" . $id[$i] .  "'><img src='" . $urls[$i] . "' alt='Image not Found'
					class='" . $liClass . "' /></a>
			</li>";
		}
		echo "</ul>";
	}
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
	imageList($urls, $ids, "preview");
?>