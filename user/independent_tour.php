<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <script src="script.js">  </script>
  <body>
    <div class="container">
      <br><br>
      <h1 ><u>Make Your Own Tour:</u></h1><br>
      <form action="tour_map_test.php">
        <div class="form-group row">
          <label for="tour_duration" class="col-sm-2 col-form-label">Tour duration:</label>
          <div class="col-sm-2.5">
            <input type="text" class="form-control" id="tour_duration" placeholder="Enter time in minutes...">
          </div>
        </div>
        <div class="form-group row">
          <label for="cafiteria_radio" class="col-sm-2 col-form-label">Cafiteria:</label>
          <div class="col-sm-2.5" id="cafiteria_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="cafiteria_yes" name="cafiteria" class="custom-control-input">
              <label class="custom-control-label" for="cafiteria_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="cafiteria_no" name="cafiteria" class="custom-control-input">
              <label class="custom-control-label" for="cafiteria_no">No</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="accessible_radio" class="col-sm-2 col-form-label">Accessible:</label>
          <div class="col-sm-2.5" id="accessible_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input">
              <label class="custom-control-label" for="accessible_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_no" name="accessible" class="custom-control-input">
              <label class="custom-control-label" for="accessible_no">No</label>
            </div>
          </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="by_categories_tab" data-toggle="tab" href="#by_categories" role="tab" aria-controls="by_categories" aria-selected="true">By Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="by_points_tab" data-toggle="tab" href="#by_points" role="tab" aria-controls="by_points" aria-selected="false">By Points Of Interest</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="by_categories" role="tabpanel" aria-labelledby="by_categories_tab"><br>
            <div id="by_categories_dropdown"></div>
          </div>
          <div class="tab-pane fade" id="by_points" role="tabpanel" aria-labelledby="by_points_tab"><br>
            <div id="by_points_dropdown"></div>
          </div>
        </div>

        <br><br><br>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
      <script type="text/javascript">
      document.getElementById("by_categories_tab").addEventListener("click",function(){
        document.getElementById("by_points_dropdown").innerHTML="";
        document.getElementById("by_categories_dropdown").innerHTML="<select id='categories' width=50px></select>";
        showCategory();
      });
      document.getElementById("by_points_tab").addEventListener("click",function(){
          document.getElementById("by_categories_dropdown").innerHTML="";
        document.getElementById("by_points_dropdown").innerHTML="<select id='categories' width=50px ></select>";
        showCategory();
      });

    function showCategory(){
      var query='select * from category';
      callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
    }

      </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
