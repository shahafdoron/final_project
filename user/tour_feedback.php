<!DOCTYPE html>
<?php include("../db_conn.php");
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <?php include("navs.php"); ?>

    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="homepage_user.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="independent_tour.php">Independent Tour</a>
        </li>
        <li class="breadcrumb-item">
          <a href="tour_map.php">Map</a>
        </li>
        <li class="breadcrumb-item active">Feedback</li>

      </ol>


      <div class="container border" >
        <h1 ><u>Feedback:</u></h1><br>
        <div id="feedback"></div>
        <br>
        <div class="form-group" >
          <div class="col-auto mr-auto">
            <button type="button" class="btn btn-primary" onclick="sendFeedback()">Submit</button>
          </div>
        </div>
      </div>

      </div>

      <?php print_r( $_SESSION["tour_points"] );?>

    <script type="text/javascript">

      var sorted_json_points= (<?php print_r(json_encode($_SESSION["tour_points"])); ?>);
      var div_el=document.getElementById("feedback");
      var ht='';
      console.log(sorted_json_points);
      for (var i=1; i<sorted_json_points.length;i++){
        ht+='<div class="form-group row mt-3 ml-3 mb-3 mr-3 border">';
        ht+='<div class="col-sm-2 col-form-label">';
        ht+='<label for="point_name" >'+sorted_json_points[i].name+'</label></div>';
        ht+='<div class="col-sm-8 mt-2 ml-2 mb-2 mr-2" id="'+sorted_json_points[i].name+'">';
        console.log("here");
        for (var j = 1; j < 6; j++) {
          ht+='<div class="custom-control custom-radio custom-control-inline">';
          if (j==1){
            ht+='<input type="radio" id="'+j+'_'+sorted_json_points[i].point_id+'" name="'+sorted_json_points[i].point_id+'" class="custom-control-input" value="'+j+'" checked>';
          }
          ht+='<input type="radio" id="'+j+'_'+sorted_json_points[i].point_id+'" name="'+sorted_json_points[i].point_id+'" class="custom-control-input" value="'+j+'">';

          ht+='<label class="custom-control-label" for="'+j+'_'+sorted_json_points[i].point_id+'" >'+j+'</label>';
          ht+='</div>';
        }
        ht+='</div></div>';
      }
      // ht+='</div></div>';
      div_el.innerHTML=ht;


      function sendFeedback(){
        var points_ranking_by_user={};
        var sorted_json_points= (<?php print_r(json_encode($_SESSION["tour_points"])); ?>);
        for (var i=1;i<sorted_json_points.length;i++){
          // console.log(sorted_json_points[i].name);
          var p_id=sorted_json_points[i].point_id;
          var val=document.querySelector('input[name = "'+p_id+'"]:checked').value;
            console.log(val);
          points_ranking_by_user[p_id]=val;

          }

          console.log(points_ranking_by_user);
      }
    </script>

          <!-- <label  class="control-label col-sm-3 border">cafeteria:</label> -->
            <!-- <div class="row" id="cafeteria_radio"> -->
              <!-- <div class="custom-radio custom-control-inline border">
                <input type="radio" id="1" name="cafeteria" class="custom-control-input border"  value="1" checked >
                <label class="custom-control-label" for="1">1</label>
              </div> -->
              <!-- <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="2" name="cafeteria" class="custom-control-input" value="2">
                <label class="custom-control-label" for="2">2</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="3" name="cafeteria" class="custom-control-input" value="3">
                <label class="custom-control-label" for="3">3</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="4" name="cafeteria" class="custom-control-input" value="4">
                <label class="custom-control-label" for="4">4</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="5" name="cafeteria" class="custom-control-input" value="5">
                <label class="custom-control-label" for="5">5</label>
              </div> -->
            <!-- </div> -->





      <!-- <div class="row-md-2 border"> -->


   <!-- </div> -->


      <!-- <div class="contaner border">
        <div class="form-group row">
          <label for="cafeteria_radio" class="col-sm-2 col-form-label">cafeteria:</label>
          <div class="row">

            <div class="col-sm-2.5" id="cafeteria_radio">
              <div class="custom-control custom-radio custom-control-inline ">
                <input type="radio" id="cafeteria_yes" name="cafeteria" class="custom-control-input" onchange="document.getElementById('cafeteria_time').style.visibility='visible' ;" value="1" >
                <label class="custom-control-label" for="cafeteria_yes">Yes</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cafeteria_no" name="cafeteria" class="custom-control-input" checked onchange="document.getElementById('cafeteria_time').style.visibility='hidden';" value="0">
                <label class="custom-control-label" for="cafeteria_no">No</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="number" id="cafeteria_time" name="cafeteria_time" class="form-control" value="0" min="0" max="25" step="5"  style="visibility:hidden" required >

              </div>
            </div>
          </div>
        </div>

      </div> -->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
