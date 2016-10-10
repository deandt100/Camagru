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
  			<li class="icon">
  		  		<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  			</li>
		</ul>
		</header>
		<div id="wrapper">
			
			<nav class="navleft">
				<div class="innertube">
				<center>
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
						   
							<img id="userImg" src="">
						<canvas id="canvas" style="display:none;"></canvas>
						   <div id="upload_status">Click video feed take a snapshot! </div>

					</div>
			<nav class="navright">
				<div class="innertube">
					<h3>Right heading</h3>
					<ul>
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
						<li><a href="#">Link 4</a></li>
						<li><a href="#">Link 5</a></li>
					</ul>
					<h3>Right heading</h3>
					<ul>
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
						<li><a href="#">Link 4</a></li>
						<li><a href="#">Link 5</a></li>
					</ul>
					<h3>Right heading</h3>
					<ul>
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
						<li><a href="#">Link 4</a></li>
						<li><a href="#">Link 5</a></li>
					</ul>
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