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
			<li><a href="photoBooth.php">Photo Booth</a></li>
  			<li class="icon">
  		  		<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  			</li>
</ul>
<form action="action_page.php">
 
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><a href="#"> Forgot password</a> </span>
  </div>
</form>
</html>