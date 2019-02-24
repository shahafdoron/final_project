<!DOCTYPE html>
<?php

include('db_conn.php');
$error='';
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

if (isset($_POST["emailAddress"]) && isset($_POST["password"])){
  validate_email_password();
}

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="user/style/style.css" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <title></title>
  </head>
  <body>

    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <div class="fadeIn first">
          <br><br>
        </div>

        <!-- Login Form -->
        <form id="login"  action="index.php" method="post"  >
          <input type="text" id="emailAddress" name="emailAddress" placeholder="Email Address"  required oninvalid="this.setCustomValidity('Please Enter valid email')"
          oninput="setCustomValidity('')">
          <input type="text" id="password" name="password" placeholder="Passowrd" required  oninvalid="this.setCustomValidity('Please a password')"
          oninput="setCustomValidity('')">
          <input type="submit" name="submit "class="fadeIn fourth" value="Log In">
          <div >
            <h3><?php echo  $error?></h3>
          </div>
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

      </div>
    </div>


  </body>
</html>
