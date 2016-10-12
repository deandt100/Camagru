<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Change Password</title>
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
<form id="changeForm" name="changeForm" action="src/changeUserPassword.php" method="POST">
 
  <div class="container">
    <label><b>New Password</b></label>
		<?php
			echo '<input type="hidden" name="user" value=' . $_GET["verif"] . '>';
		?>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label><b>Confirm New Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confpsw" required>

    <button type="button" onclick="submitChangeForm()">Change Password</button>
  </div>
</form>
<script type="text/javascript" src="src/changeUserPassword.js"></script>
</html>