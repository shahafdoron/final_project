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
}?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="user/style/style.css" type="text/css">


    <title></title>
  </head>
  <body>
   <div class="container">
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
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
