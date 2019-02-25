<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
    $tour='';
    if(isset($_REQUEST['tour'])){
      $tour=$_REQUEST['tour'];
    }
     ?>
    <meta charset="utf-8">
      <link rel="stylesheet" href="style/innerWindow.css" type="text/css">
    <title>
    <h2>Enter date range for existing tours</h2>
    </title>
  </head>
  <body>
    <script>
      var tour_info=(<?php echo $tour; ?>);
      console.log(tour_info);
    </script>


  </body>
</html>
