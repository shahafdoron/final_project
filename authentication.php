<?php
session_start();
include ("db_conn.php");
$_SESSION["emailAddress"]=$_REQUEST["emailAddress"];
$_SESSION["password"]=$_REQUEST["password"];

echo $_SESSION["emailAddress"];
echo $_SESSION["password"];
 ?>
