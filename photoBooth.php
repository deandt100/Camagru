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
			
			<nav id="filmstrip" class="navleft" >
				<div class="innertube">
				<center>
					<?php
						include "src/filmStrip.php";
					?>
				</center>
				</div> 
			</nav>
					<div class="video_container">
   						<video autoplay="true" id="videoElement"></video><br>
						   <div class=upload>
						   		<p>Image Upload</p>
								<form id="image_upload_form" enctype="multipart/form-data" method="post">
									<input type="file" name="file1" id="image1"><br>
									<input type="button" value="Upload File" onclick="userUpload()">
									<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
									<h3 id="status"></h3>
									<p id="loaded_n_total"></p>
								</form>
								<br>
						   </div>
						<canvas id="canvas" style="display:none;"></canvas>
						   <div id="upload_status">Click video feed take a snapshot! </div>

					</div>
			<nav class="navright">
				<div class="innertube">
					<h3>Select overlay</h3>
						<div>
						<ul class="overlay_select" id="overlay_select">
							<li id="ovr1" class="overlay_li" onclick="setActiveOverlay(1)" ><img class="overlay_img" id="pine_tree" src="overlay/pine_tree.png"></li>
							<li id="ovr2" class="overlay_li" onclick="setActiveOverlay(2)"><img class="overlay_img" id="peepo" src="overlay/peepo.png"></li>
							<li id="ovr3" class="overlay_li" onclick="setActiveOverlay(3)"><img class="overlay_img" id="zeal" src="overlay/zeal.png"></li>
						</ul>
						</div>
				</div>
			</nav>
			
		
		</div>
		
		<footer>
			<div class="innertube">
				<p>Footer...</p>
			</div>
		</footer>
		<script type="text/javascript" src="src/takePhoto.js"></script>
		<script type="text/javascript" src="src/upload.js"></script>
	</body>
</html>