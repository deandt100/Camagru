<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>pp.0</title>
		<link rel="Stylesheet" type="text/css" href="style.css">
		<link rel="Stylesheet" type="text/css" href="gallery.css">
		<style type="text/css"></style>
		<script type="text/javascript"></script>	
	</head>
	<body>		
		<header>
		<ul class="topnav" id="myTopnav">
			<li class="active"><a href="index.php">Home</a></li>
			<?php
				session_start();
				if ($_SESSION["logged_on_user"] != "")
					echo '<li><a href="photoBooth.php">Photo Booth</a></li>';
				else
				{
					echo '<li style="float:right"><a href="registerForm.php">Register</a></li>';
  					echo '<li style="float:right"><a href="loginForm.php">Login</a></li>';
				}
				if ($_SESSION["logged_on_user"] != "")
				{
					echo '<li style="float:right"><a href="src/logout.php">Logout</a></li>';
					echo '<li style="float:right"><a href="changePass.php?verif=' . hash("whirlpool", $_SESSION["logged_on_user"]) . '">Change Password</a></li>';
				}
			?>
  			<li class="icon">
  		  		<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  			</li>
		</ul>
		</header>
		<div id="wrapper">
			<main style="width:100%">
						<center>
						<h1>Gallery</h1>

						</center>
						<p class='index'> Page index : </p>
							<div class="container">
								<?php
									include "src/getImages.php";
								?>
						</div>
			</main>	
		</div>
		<footer>
			<div class="innertube">
				<p>Footer...</p>
			</div>
		</footer>
	
	</body>
</html>