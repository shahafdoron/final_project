<?php
include("../db_conn.php");
// $query="select * from category";
$query=$_REQUEST['query'];
$jsonData=extract_data_to_json($query);
echo $jsonData;
 ?>
