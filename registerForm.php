<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Register</title>
		<link rel="Stylesheet" type="text/css" href="form_style.css">
		<style type="text/css"></style>
			
</head>
<body>
<form name="register" method="post" action="src/registerUser.php">
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
    <input id="confpassword" type="password" placeholder="Enter Password" name="psw" required>
    <label class="badInput" id="message"><b></b></label>
    <button onclick ="verifyDetails()" type="button">Register</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
  <script type="text/javascript">

  function verifyDetails()
  {
    //usermname
    var username = document.getElementById("username");
      if (username.value.length < 6 || username.value.length > 24)
      {
        
        document.getElementById("message").innerHTML = "Username must be between 6 and 24 characters long.";
        username.style.borderColor = "#c55";
        username.focus();
        return;
        err = true;
      }
      else
        username.style.borderColor = "#5c5";
      var filter = /^[A-Za-z0-9_-]+$/;
      if (!filter.test(username.value))
      {
        document.getElementById("message").innerHTML = 'Only alpha-numeric characters and "-" or "_" are allowed in the username';
        username.style.borderColor = "#c55";
        username.focus();
        return;
      }
      else
        username.style.borderColor = "#5c5";
  
      //Email
      var email = document.getElementById("email");
      if (checkEmail() == false)
      {
        document.getElementById("message").innerHTML = 'Please provide a valid email address.';
        email.focus();
        email.style.borderColor = "#c55";
        err = true;
        return;
      }
      else
        email.style.borderColor = "#5c5";
      
      var confemail = document.getElementById("confemail");
      if (email.value != document.getElementById("confemail").value)
      {
        document.getElementById("message").innerHTML = 'Emails do not match.';
        confemail.focus();
        confemail.value = "";
        confemail.style.borderColor = "#c55";
        return;
      }
      else
        confemail.style.borderColor = "#5c5";

      //password
      var passwd = document.getElementById("password");
      if (passwd.value.length < 6)
      {
        document.getElementById("message").innerHTML = "Password Should be Minimum 6 Characters";
        passwd.focus();
        passwd.value = "";
        passwd.style.borderColor = "#c55";
        return;
      }
      else
        passwd.style.borderColor = "#5c5";
      var confpasswd = document.getElementById("confpassword");
      if (passwd.value != document.getElementById("confpassword").value)
      {
        document.getElementById("message").innerHTML = "Passwords do not match.";
        passwd.focus();
        confpasswd.value = "";
        passwd.value = "";
        passwd.style.borderColor = "#c55";
        confpasswd.style.borderColor = "#c55";
        return;
      }
      else
        confpasswd.style.borderColor = "#5c5";
      document.getElementById("message").innerHTML = '';
  }

  function checkEmail() 
  {
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value))
    {
      return false;
    }
  }

  function chkPasswordStrength()
   {
     var desc = new Array();
     desc[0] = "very weak";
     desc[1] = "weak";
     desc[2] = "better";
     desc[3] = "medium";
     desc[4] = "strong";
     desc[5] = "strongest";

     var score = 0;
     var pass = document.getElementById('password');
     var pstring = document.getElementById('pstr');
     var txtpass = pass.value;
     var errMsg;

     //if txtpass bigger than 6 give 1 point
    if (txtpass.length >= 6) 
    {
      score++;
     //if txtpass has both lower and uppercase characters give 1 point
     if ( ( txtpass.match(/[a-z]/) ) && ( txtpass.match(/[A-Z]/) ) ) score++;
     //if txtpass has at least one number give 1 point
     if (txtpass.match(/\d+/)) score++;
     //if txtpass has at least one special caracther give 1 point
     if ( txtpass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;
     //if txtpass bigger than 12 give another 1 point
     if (txtpass.length > 12) score++;
     pstring.innerHTML = "strength " + desc[score];
     pstring.className = "strength" + score;
    }
    else
       pstring.innerHTML = "";

   }
  </script>
</body>
</form>
</html>