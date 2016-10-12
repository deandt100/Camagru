<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Login</title>
		<link rel="Stylesheet" type="text/css" href="form_style.css">
    <link rel="Stylesheet" type="text/css" href="style.css">
		<style type="text/css"></style>
		<script type="text/javascript"></script>	
</head>
<ul class="topnav" id="myTopnav">
			<li><a href="index.php">Home</a></li>
  			<li class="icon">
  		  		<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  			</li>
</ul>
<form id="resetForm" name="resetForm" action="src/sendPasswordEmail.php" method="POST">
 
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
	 <button type="button" onclick="submitResetForm()">Change Password</button>
  </div>
</form>
<script type="text/javascript" src="src/sendPasswordEmail.js"></script>
</html>