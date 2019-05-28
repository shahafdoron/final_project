<!DOCTYPE html>
<?php include("../db_conn.php"); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>

</head>

<script src="script.js">  </script>

<body>




  <!-- Navigation -->
  <?php include('navs.php'); ?>
  <div class="container">



    <div class="container">
      <h1 class="display-3 text-center">Welcome to Weizmann Institute of Science Tour Planning System </h1>
      <p></p>
    </div>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner ">
          <div class="carousel-item active">
            <img class="w-100" src="../user/wolfson.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="w-100" src="../images/points/22.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="w-100" src="../images/points/74.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
<br><br><br>
      <div >
        <h1 class="display-4 text-center">See some of our leadest points of interest</h1>
        <h2 class="display-6 text-center">*You can find other points by checking "points information" section</h2>
      </div>
<div id="top_points" class="container">

</div>
<script type="text/javascript">
  var query="SELECT * FROM point_of_interest where point_of_interest.category_id not in ('3','7') ORDER BY point_of_interest.average_ranking DESC LIMIT 6 ";
  var user_type=<?php echo $_SESSION["user_type"]; ?>;
    callAjax(concatenatePoints,'../db_conn.php?query='+query,"top_points");
</script>

</div>
<!-- Footer -->
<footer class="card-footer font-small">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mb-4">VISITORS CENTER</h5>
        <p>Feel free to contact with us during visitor center working hours: Sunday - Thursday 9:00-16:00</p>

        <p>Maps and walking tour instructions are available at the Levinson Visitors Center</p>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->

        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1">

          <!-- Contact details -->
          <h5 class="font-weight-bold text-uppercase mb-4">CONTACT DETAILS</h5>

          <ul class="list-unstyled">
            <li>
              <p>
                <i class="fas fa-home mr-3"></i>234 Herzl St,Rehovot,Israel</p>
              </li>
              <li>
                <p>
                  <i class="fas fa-envelope mr-3"></i> contact-us@weizmann.ac.il</p>
                </li>
                <li>
                  <p>
                    <i class="fas fa-phone mr-3"></i> + 972 (0) 8-934-4499</p>
                  </li>

                  </ul>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-4 col-lg-2 text-center mx-auto my-4">

                  <!-- Social buttons -->
                  <h5 class="font-weight-bold text-uppercase mb-4">Follow Us</h5>

                  <!-- Facebook -->
                  <a class="btn-floating btn-lg btn-fb" type="button" role="button" href="https://he-il.facebook.com/WeizmannInstituteOfScience/">
                    <i class="fab fa-facebook-f"></i>
                  </a>


                  <!-- Twitter -->

                  <a type="button" class="btn-floating btn-lg btn-tw" href="https://twitter.com/weizmannscience">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <!--Instagram-->


                </div>
                <!-- Grid column -->

              </div>
              <!-- Grid row -->

            </div>
            <!-- Footer Links -->

            <!-- Copyright -->

            <!-- Copyright -->

          </footer>
          <!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white"></p>
  </div>
</footer>


</div><!-- container -->

<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
