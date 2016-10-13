<?php
	function pageIndex($count, $imgPerPage)
	{
		$pages = ceil($count / $imgPerPage);
		$i = 0;
		while ($i < $pages)
		{
			$link = "index.php?page=" . ($i + 1);
			echo "<a class='pg_index' href='" . $link . "'> " . ($i + 1) . " </a>";
			$i++;
		}
		echo "<br>";
		return $pages;
	}
?>