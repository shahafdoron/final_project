<?php
$host="localhost";
$username = "root";
$password = "";
$database= "final_project";
$conn =  mysqli_connect($host,$username,$password,$database);
session_start();
if (!$conn){
  die("Database connection has failed!");
}

function validate_email_password(){

  global  $conn;
  $emailAddress=$_POST['emailAddress'];
  $password=$_POST['password'];
  $emailAddress=mysqli_real_escape_string($conn,$emailAddress);
  $password=mysqli_real_escape_string($conn,$password);

  $query= "select * from user where user.Email='" . $emailAddress . "' and user.Password=" . $password ."";
  $result=mysqli_query($conn,$query);

  if ($row=mysqli_fetch_assoc($result)){
    $_SESSION["emailAddress"]=$row["Email"];
    $_SESSION["password"]=$row["Password"];
    $result->free();
    header('location:user/homepage_user.php');

  }


  else {
    $_SESSION['error'] = "Incorrect login or password!";
    $conn->close();
  	header('location:index.php');

  }



}


function user_authintication($emailAddress,$password){
  if ($emailAddress=='' || $password==''){
    echo "Please enter email address and password";
  }
  // $query= "select * from user where user.Email='" . $emailAddress "' and user.Password='" . $password "''";
}
 ?>
