
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>PhotoBooth</title>
		<link rel="Stylesheet" type="text/css" href="style.css">
		<style type="text/css"></style>
		
	</head>
	<body>
		
		<header>
		<ul class="topnav" id="myTopnav">
			<li><a href="index.php">Home</a></li>
			<li class="active"><a href="photoBooth.php">Photo Booth</a></li>
			<?php
				session_start();

				if ($_SESSION["logged_on_user"] != "")
  					echo '<li style="float:right"><a href="src/logout.php">Logout</a></li>';
			?>
  			</li>
		</ul>
		</header>
		<?php
			if ($_GET["error"] == 1)
			{
				header("Location: loginForm.php");
				return ;
			}
			if ($_GET["error"] == 2)
				echo '<p>Error: Comment cannot be longer than 256 characters</p>';
		?>
		<div id="wrapper">
					<div class="image_container">
					<?php
						include "config/connect.php";

						$pdo = connect();
						session_start();
						$id = $_GET['id'];
						$user = $_SESSION['logged_on_user'];
						$sql = $pdo->query("USE db_camagru");
						$stmt = $pdo->prepare("SELECT image_url FROM images 
							WHERE image_id = '" . $id . "'");
						$stmt->execute();
						$url = $stmt->fetchAll(PDO::FETCH_COLUMN);
						if (count($url) != 1)
						{
							echo "ERROR\n";
							header("Location: index.php?error=3");
						}
						else
						{
							echo "<img id='userImg' src='" . $url[0] .  "'>";
						}
						$stmt = $pdo->prepare("SELECT user FROM images 
							WHERE image_id = '" . $id . "'");
						$stmt->execute();
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						if ($_SESSION["logged_on_user"] == $row["user"])
						{
							echo '<form id="deleteButton" name="deleteButton" action="src/deleteImage.php" method="POST">';
							echo '<input type="hidden" name="image_id" value="' . $_GET["id"] . '">';
							echo '<input type="submit" name="submit" value="delete">';
							echo '</form>';
						}
						if ($user != "")
						{
							$stmt = $pdo->prepare("SELECT like_id FROM likes
								WHERE user = :user AND image_id = :image_id");
							$stmt->bindParam(':user', $user);
							$stmt->bindParam(':image_id', $id);
							$stmt->execute();
							$likes = $stmt->fetchAll(PDO::FETCH_COLUMN);
							if (count($likes) > 0)
							{
								$likeClass = "liked";
							}
							else
								$likeClass = "unliked";
							echo '<form class = "' . $likeClass . '" id="likeButton" name="likeButton" action="src/likeImage.php" method="POST">';
							echo '<input type="hidden" name="image_id" value="' . $_GET["id"] . '">';
							echo '<input type="submit" name="submit" value="like">';
							echo '</form>';
						}
						$stmt = $pdo->prepare("SELECT like_id FROM likes
							WHERE image_id = :image_id");
						$stmt->bindParam(':image_id', $id);
						$stmt->execute();
						$likes = $stmt->fetchAll(PDO::FETCH_COLUMN);
						echo "likes = " . count($likes);
					?>
					<br>
					</div>
					<div class="comment_box">
					<div class="comment">
					<?php
						$pdo = connect();
						$id = $_GET['id'];
						date_default_timezone_set("Africa/Johannesburg");
						$pdo->query("USE db_camagru");
						$stmt = $pdo->prepare("SELECT user, date_created FROM images 
							WHERE image_id = '" . $id . "'");
						$stmt->execute();
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						echo '<p>Posted by: ' . $row["user"] . ' - ' . date("H:i d F Y", strtotime($row["date_created"])) . '</p>';
						$pdo = null;
					?>
					<p>Image link:</p>
					<?php
						$uri = $_SERVER["REQUEST_URI"];
						echo '<span id="copyText" style="background-color:green">' . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . $uri . '</span>';
					?>
					</div>
					</div>
					<br>
					<div class="comment_box">
					<form id="commentForm" name="commentForm" action="src/submitComment.php" method="POST">
					<center>
    				<textarea name="comment" cols="100" rows="10"></textarea><br>
					<?php
						include "../config/connect.php";
						session_start();
						
						$pdo = connect();
						$id = $_GET['id'];
						$pdo->query("USE db_camagru");
						$stmt = $pdo->prepare("SELECT user FROM images 
							WHERE image_id = '" . $id . "'");
						$stmt->execute();
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						echo '<input type="hidden" name = "image_id" value="' . $_GET["id"] . '">';
						echo '<input type="hidden" name = "user" value="' . $_SESSION["logged_on_user"] . '">';
						echo '<input type="hidden" name = "image_user" value="' . $row["user"] . '">';
						echo '<input type="hidden" name = "url" value="' . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . $uri . '">';
						$pdo = null;
					?>
  				  	<button type="button" onclick="submitCommentForm()">Submit</button>
					</center>
					</form>
					</div>
					<script type="text/javascript" src="src/commentSubmit.js"></script>
					<div class="comment_head">
							<h1>Comments</h1>
						</div>
					<div class="comment_box">
						<br>
						<?php
							include "../config/connect.php";

							$pdo = connect();
							$pdo->query("USE db_camagru");
							$stmt = $pdo->prepare("SELECT comment, user, date_posted FROM comments WHERE image_id = :image ORDER BY date_posted");
							$stmt->bindParam(":image", $_GET["id"]);
							$stmt->execute();
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
							{
								echo '<div class="comment">' . $row["comment"] . ' - ' . $row["user"] . ' - Posted on: ' . date("H:i d F Y", strtotime($row["date_posted"])) . '</div><br>';
							}
							$pdo = null;
						?>
						<br>
					</div>
				</div>
			<div class="innertube">
				<p style="float:right">daviwel, ddu-toit 2016</p>
			</div>	
	</body>
</html>