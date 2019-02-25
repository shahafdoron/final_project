<!DOCTYPE html>
<?php
include("../db_conn.php");
// extractPoints();
        ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title></title>
  </head>

  <body >
    <script src="script.js">  </script>

      <div class="container">
        <h2>Points of interest</h2>
        <div >
          <select id="categories" width=50px >
              <script> //function showCategories()
              var query='select * from category';
              callAjax(concatenateCategories,'file.php?query='+query); </script>
          </select>
        </div>
        <div id="points">
        </div>
      </div>
      <!-- </form> -->
  </body>
</html>
