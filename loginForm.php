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
<?php
    if ($_GET["error"] == 1)
      echo '<p>User does not exist</p>';
    else if ($_GET["error"] == 2)
      echo '<p>Incorrect password</p>';
    else if ($_GET["error"] == 3)
      echo '<p>User not verified</p>';
?>
<form id="loginForm" name="loginForm" action="src/login.php" method="POST">
 
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="button" onclick="submitLoginForm()">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><a href="changePassword.php"> Forgot password</a> </span>
  </div>
</form>
<script type="text/javascript" src="src/login.js"></script>
</html>