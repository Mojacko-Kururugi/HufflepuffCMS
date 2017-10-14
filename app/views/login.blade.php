<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>COC MANAGEMENT</title>

    <!-- STYLES START -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!-- STYLES END -->
  </head>
  <body>
    <div class="card-panel login-panel">
      <div class="login-logo">
        <img src="img/logo2.png" class="responsive-img circle" />
      </div>
      <div class="app-name center-align">OPTICAL CLINIC MANAGEMENT</div>

      <form class="login-form" action="/login" method="post">
        <div class="input-field">
          <i class="prefix mdi-social-person"></i>
          <input id="usernameTxt" type="text" name="username">
          <label for="username">Username</label>
        </div>
        <div class="input-field">
          <i class="prefix mdi-action-lock"></i>
          <input id="passwordTxt" type="password" name="password">
          <label for="password">Password</label>
        </div>
          <div class="center-btn">
            <button class="btn waves-effect waves-light blue" type="submit" name="action" id="loginbtn">Login</button>
          </div>
      </form>
    </div>

    <!-- SCRIPTS START -->
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/materialize.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      var uname = document.getElementById('usernameTxt');
      var pass = document.getElementById('passwordTxt');
      
     // alert("HAHAHAHAHA GAGO!");

      $(this).ready(function()
      {
        $("#loginbtn").click(function()
        {
          if(uname.value == "" && pass.value == "")
          {
            alert("Both fields have no input! Please enter your email and password.");
          }
          else if ((uname.value != "" && pass.value == "") || (uname.value == "" && pass.value != "")) 
          {
            if (uname.value != "" && pass.value == "") 
            {
              alert("Please enter your password.");
            }
            else if (uname.value == "" && pass.value != "") 
            {
              alert ("Please enter your email.");
            }
          }
        });
      });
    </script>
    <!-- SCRIPTS END -->
  </body>
</html>


