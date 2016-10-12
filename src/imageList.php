<?php
	function imageList($rel ,$urls, $id, $liClass)
	{
		echo "<ul class='hoverbox'>";
		$count = count($id);
		for($i = 0 ; $i < $count; $i++)
		{
			echo "
			<li class='$liClass'>
				<a href='" . $rel . "imageComment.php?id=" . $id[$i] .  "'><img src='" . $rel . $urls[$i] . "' alt='Image not Found'
					class='" . $liClass . "'/></a>
			</li>";
		}
		echo "</ul>";
	}
?>