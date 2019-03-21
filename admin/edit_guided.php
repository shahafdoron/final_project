<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="../user/style/innerWindow.css" type="text/css">

    <title></title>
    <u>
    <!-- <h2>Enter date range for existing tours</h2> -->
  </u>
  </head>
  <body>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="by_existing_tab" data-toggle="tab" href="#admin_div" role="tab" aria-controls="by_existing" aria-selected="true">Edit Existing Tours</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="by_new_tab" data-toggle="tab" href="#admin_div" role="tab" aria-controls="by_new" aria-selected="false">Create A New Tour</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div id="admin_div">
          <iframe id="edit_frame" class="edit_frame" src="" frameborder="0";></iframe>

            <script type="text/javascript">
            document.getElementById("by_existing_tab").addEventListener("click",function(){
              document.getElementById("edit_frame").src="../user/enter_dates_guided.php";
            });
            document.getElementById("by_new_tab").addEventListener("click",function(){
              document.getElementById("edit_frame").src="../user/my_tours.php";
            });
            // showCategory();'
            // document.getElementById("by_new_tab").addEventListener("click",function(){
            //     document.getElementById("by_new_div").innerHTML="";
            //   document.getElementById("by_new_div").innerHTML="<div id='new_tour' width=50px ></select>";
            //   showCategory();
            // });

            // function showCategory(){
            //   var query='select * from category';
            //   callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
            // }

            </script>

        </div>
    </div>

  <!-- <br>
  <form action="Existing_guided_Tour.php">
  Starting Date: <input type="date" name="enter">
  <br>
  <br>
  <br>
  Finishing Date: <input type="date" name="finish">
  <br>
  <br>
  <br>
  Accessibility:
  <input type="radio" name="access" value="1" > Yes
  <input type="radio" name="access" value="0" checked="checked"> No
  <br>
  <br>
  <br>
  <input type="submit">
  </form> -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
