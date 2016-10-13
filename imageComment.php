
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
  			<li style="float:right"><a href="loginForm.php">Login</a></li>
  			</li>
		</ul>
		</header>
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
						$stmt = $pdo->prepare("SELECT like_id FROM likes
							WHERE user = :user AND image_id = :image_id");
						$stmt->bindParam(':user', $user);
						$stmt->bindParam(':image_id', $id);
						$stmt->execute();
						$likes = $stmt->fetchAll(PDO::FETCH_COLUMN);
						echo "likes = " . count($likes);
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
					?>
					<!-- 
					<form id="likeButton" name="likeButton" action="src/likeImage.php" method="POST">
						<input type="hidden" name="image_id" value="<?php echo $_GET["id"] ?>">
						<input type="submit" name="submit" value="like">
					</form>
					-->
					<br>
					</div>
					<div class="comment_box">
					<div class="comment">
					<p>Image link:</p>
					<?php
						$uri = $_SERVER["REQUEST_URI"];
						echo '<span id="copyText" style="background-color:green">' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $uri . '</span>';
					?>
					</div>
					</div>
					<br>
					<div class="comment_box">
					<form id="commentForm" name="commentForm" action="src/submitComment.php" method="POST">
    				<textarea name="comment" cols="100" rows="10"></textarea>
					<?php
						session_start();

						echo '<input type="hidden" name = "image_id" value="' . $_GET["id"] . '">';
						echo '<input type="hidden" name = "user" value="' . $_SESSION["logged_on_user"] . '">';
					?>
  				  	<button type="button" onclick="submitCommentForm()">Submit</button>
					</form>
					</div>
					<script type="text/javascript" src="src/commentSubmit.js"></script>
					<div class="comment_box">
						<div class="comment_head">
							<h1  >Comments </h1>
						</div>
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
	</body>
</html>