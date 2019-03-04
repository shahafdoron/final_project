<?php session_start();
$email= $_SESSION['emailAddress'];
$user_id=$_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <script src="script.js">  </script>


    <br><br>
    <div class="container">
      <h1 ><u>My Schedule:</u></h1><br>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active" id="future">
          <input type="radio" name="options"  > My future tours
        </label>
        <label class="btn btn-secondary" id="past">
          <input type="radio" name="options" id="option2"  > My past tours
        </label>
      </div>
      <div id="my_tours_schedule">
        <script type="text/javascript">
        // document.getElementById("o").addEventListener("click", function(){
        //   console.log("ASDASDASDASD");
        // });
        if (document.getElementById("future").click){
          console.log("asd");
        }
          var user_id= <?php echo $user_id; ?>;
          var query_independent="SELECT * FROM user,tour,independent_tour WHERE user.user_id='"+user_id+"' AND tour.tour_id=independent_tour.independent_tour_id AND user.user_id=independent_tour.independent_tourist_id ";            callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_independent);
          var query_guided="SELECT * FROM user, tour, guided_tour, guided_tour_registration WHERE user.user_id='"+user_id+"' AND user.user_id=guided_tour_registration.registered_tourist_id AND tour.tour_id=guided_tour.guided_tour_id AND guided_tour.guided_tour_id=guided_tour_registration.guided_tour_id ";
          callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_guided);
        </script>
      </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
