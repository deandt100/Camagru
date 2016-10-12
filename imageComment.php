
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
						session_start();
						$user = $_SESSION['logged_on_user'];	
						if ($_SESSION['logged_on_user'] == "")
							exit;
						if ($_SESSION['fs'])
						{
							$_SESSION['fs'] = !$_SESSION['fs'];
							header('Location: imageComment.php');
						}
						$pdo = connect();
						$id = $_GET['id'];
						$sql = $pdo->query("USE db_camagru");
						$stmt = $pdo->prepare("SELECT image_url FROM images 
							WHERE image_id = '" . $id . "'");
						$stmt->execute();
						$url = $stmt->fetchAll(PDO::FETCH_COLUMN);
						if (count($url) != 1)
						{
							echo "ERROR\n";
							//redirect
						}
						else
						{
							echo "<img id='userImg' src='" . $url[0] .  "'>";
						}
					?>
					<br>
					</div>

					<div class="comment_box">
						<div class="comment_head">
							<h1  >Comments </h1>
						</div>
						<div class="comment">
							THE ACTUAL COMMENT
						</div>
						<div class="comment">
							THE ACTUAL COMMENT
						</div>
						<div class="comment">
							THE ACTUAL COMMENT
						</div>
						<br>
						<?php
							//include "config/connect.php";
						?>
					</div>
					
			
		
		</div>
		
		<footer>
			<div class="innertube">
				<p>Footer...</p>
			</div>
		</footer>
	</body>
</html>