<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Register</title>
		<link rel="Stylesheet" type="text/css" href="form_style.css">
    <link rel="Stylesheet" type="text/css" href="style.css">
		<style type="text/css"></style>
	
</head>
<body>
<ul class="topnav" id="myTopnav">
			<li><a href="index.php">Home</a></li>
  			<li class="icon">
  		  		<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  			</li>
</ul>
<?php
    if ($_GET["error"] == 1)
      echo '<p>Invalid username</p>';
    else if ($_GET["error"] == 2)
      echo '<p>Invalid email</p>';
    else if ($_GET["error"] == 3)
      echo '<p>Password does not match or password is too short</p>';
    else if ($_GET["error"] == 4)
      echo '<p>Username already in use</p>';
    else if ($_GET["error"] == 5)
      echo '<p>Email already in use</p>';
?>
<form id="regform" name="register" method="POST" action="src/registerUser.php">
  <div class="container">
    <label><b>Username</b></label>
    <input id="username" type="text" placeholder="Enter Username between 6 and 24 charactes long" name="uname" required>

 	<label><b>Email</b></label>
    <input id="email" type="text" placeholder="Enter email address" name="email" required>

	 <label><b>Confirm Email</b></label>
    <input id="confemail" type="text" placeholder="Enter email address" name="cemail" required>

    <label><b>Password <span id="pstr"></span> </b></label>
    <input oninput="chkPasswordStrength()" id="password" type="password" placeholder="Enter Password" name="psw" required>

	 <label><b>Confirm Password</b></label>
    <input id="confpassword" type="password" placeholder="Enter Password" name="confpsw" required>
    <label class="badInput" id="message"><b></b></label>
    <button onclick ="verifyDetails()" type="button">Register</button>
  </div>
</form>
  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
  <script type="text/javascript" src="src/registerUser.js"></script>
</body>

</html>