<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <title></title>
  </head>
  <body>

    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
          <br><br>
        </div>

        <!-- Login Form -->
        <form action="autintication.php" method="post">
          <input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
          <input type="text" id="password" class="fadeIn third" name="login" placeholder="password">
          <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

      </div>
    </div>

  <!-- <form class="" action="autintication.php" method="post">
    <table style="width: 50%" align="center">
  		<tr>
  			<td>User name</td>
  			<td><input name="userName" id="userName" type="text" ></td>
  		</tr>
  		<tr>
  			<td>Enter password</td>
  			<td><input name="password" id="password" type="password" ></td>
  		</tr>
  		<tr>
  			<td><input name="login" type="submit" value="login" ></td>

  		</tr>
  	</table>
  </form> -->
  </body>
</html>
