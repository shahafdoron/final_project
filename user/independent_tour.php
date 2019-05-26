<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  .btn-close-custom {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
  }

  /* Darker background on mouse-over */
  .btn-close-custom:hover {
    background-color: RoyalBlue;
  }
  .pt-3-half {
    padding-top: 1.4rem;
  }
  </style>


</head>

<body>
  <script src="script.js">  </script>
  <?php include('navs.php'); ?>

  <div class="container border shadow p-3 mb-5 bg-white rounded" >
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Build A Tour</li>
    </ol>

    <div class="container border shadow p-3 mb-5 bg-white rounded">


      <h1 ><u>Build A Tour:</u></h1><br>
      <form action=""  accept-charset="UTF-8" method='POST' name="tour_details_form" id="tour_details_form">

        <!-- <form action="tour_map.php"> -->
        <div class="form-group row">
          <label for="planned_tour_date_time" class="col-3 col-form-label">Date and Time:</label>
          <div class="col-sm-2.5">
            <input type="datetime-local" class="form-control" id="planned_tour_date_time" name="planned_tour_date_time"  step="1" required >
            <script type="text/javascript">

            var now=new Date(new Date().toString().split('GMT')[0]+' UTC').toISOString().split('.')[0];
            // var now=new Date();
            // now=now.setMinutes(now.getMinutes() + 15);
            // now=now.toString().split('GMT')[0]+' UTC').toISOString().split('.')[0]
            size=now.length;
            now=now.slice(0,size-2);
            now+="00";
            document.getElementById("planned_tour_date_time").value=now;
            document.getElementById("planned_tour_date_time").min=now;
            console.log("aasd" +typeof(now)) ;

            console.log(now);
            </script>
          </div>
        </div>

        <div class="form-group row">
          <label for="tour_duration" class="col-3 col-form-label" >Tour duration (minutes):</label>
          <div class=" col-sm-3 custom-control custom-control-inline ">
            <!--  working!!!<input type="number" id="tour_duration_time" name="tour_duration_time" class="form-control" value="45" min="45" max="300" step="5" onKeyDown="return false" required > -->
            <button id="minus_tour_duration_time" class="btn btn-light border" type="button" onclick="incrementInput('tour_duration_time','45','360','-5','positive','time_left_label')" ><i class="far fa-minus-square fa-lg"></i></button>
            <input type="text"  id="tour_duration_time" name="tour_duration_time" class="form-control text-center w-25 border" value="45"  onkeydown="return false" required >
            <button id="plus_ctour_duration_time" class="btn btn-light border" type="button" onclick="incrementInput('tour_duration_time','45','360','5','positive','time_left_label')" ><i class="far fa-plus-square fa-lg"></i></button>
          </div>
        </div>
        <div class="form-group row">
          <label for="participants" class="col-3 col-form-label">Participants:</label>
          <div class="col-sm-2.5">
            <input type="number" id="participants" name="participants" class="form-control" value="1" min="1" max="20" step="1" onKeyDown="return false" required >

          </div>
        </div>
        <div class="form-group row">
          <label for="cafeteria_radio" class="col-3 col-form-label">Cafeteria:</label>

          <div class="custom-control custom-radio custom-control-inline mt-1 ">
            <input type="radio" id="cafeteria_yes" name="cafeteria" class="custom-control-input" onchange="document.getElementById('cafeteria_time_div').style.visibility='visible' ;" value="1"  onkeydown="return false">
            <label class="custom-control-label" for="cafeteria_yes">Yes</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline mt-1">
            <input type="radio" id="cafeteria_no" name="cafeteria" class="custom-control-input" checked onchange="document.getElementById('cafeteria_time_div').style.visibility='hidden';" value="0">
            <label class="custom-control-label" for="cafeteria_no">No</label>
          </div>
          <div id="cafeteria_time_div" class="custom-control custom-radio custom-control-inline " style="visibility:hidden">
            <!-- working!! <input type="number" id="cafeteria_time" name="cafeteria_time" class="form-control" value="0" min="0" max="25" step="5"  style="visibility:hidden" required > -->

            <button id="minus_cafeteria_time" class="btn btn-light border" type="button" onclick="incrementInput('cafeteria_time','0','25','-5','negative','time_left_label')" ><i class="far fa-minus-square fa-lg"></i></button>
            <input type="text"  id="cafeteria_time" name="cafeteria_time" class="form-control text-center w-25 border" value="0"   required >
            <button id="plus_cafeteria_time" class="btn btn-light border" type="button" onclick="incrementInput('cafeteria_time','0','25','5','negative','time_left_label')" ><i class="far fa-plus-square fa-lg"></i></button>

          </div>
          <!-- </div> -->
          <!-- </div> -->
        </div>
        <div class="form-group row">
          <label for="accessible_radio" class="col-3 col-form-label">Accessibility:</label>
          <div class="col-sm-2.5" id="accessible_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input" value="1">
              <label class="custom-control-label" for="accessible_yes" >Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_no" name="accessible" class="custom-control-input" value="0"checked >
              <label class="custom-control-label" for="accessible_no" >No</label>
            </div>
          </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="tab_by_categories" data-toggle="tab" href="#by_categories" role="tab" aria-controls="by_categories" aria-selected="true" onclick="document.getElementById('selected_tab').value=1;">By Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab_by_points" data-toggle="tab" href="#by_points" role="tab" aria-controls="by_points" aria-selected="false" onclick="document.getElementById('selected_tab').value=0;">By Points Of Interest</a>
          </li>
          <input type="hidden" id="selected_tab" name="sel_tab" value="1" />
        </ul>

        <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active" id="by_categories" role="tabpanel" aria-labelledby="tab_by_categories" >

            <div class="container">
              <div class="row mt-3">
                <div class="col-auto mr-auto">
                  <select class='custom-select' id='categories_by_categories_option'  onchange="createCategoryInput('categories_by_categories_option','div_by_categories')"><script>showCategory("categories_by_categories_option");</script></select><br>
                </div>
              </div>
              <div class="row mt-3">
                <div id="div_by_categories" class="row"  >  </div>
                <!-- <div id="div_by_categories" class="col-auto mr-auto"  >  </div> -->
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="by_points" role="tabpanel" aria-labelledby="tab_by_points" >
            <div class="container">
              <div class="row mt-3">
                <div class="col-auto mr-auto">
                  <select class='custom-select' id='categories_by_points_option'  onchange="createSelectPoints('categories_by_points_option','div_by_points','table_points')"><script>showCategory("categories_by_points_option");</script></select><br>
                </div>
                <div class="col md-4" >
                  <h4  class="btn btn-light btn-md"> <span id="time_left_label" value="45" class="badge badge-pill "><script>//setTimeLeft(); </script></span></h4>

                </div>
              </div>
              <div class="row mt-3">
                <div class="col-auto mr-auto" id="div_by_points"></div>
              </div>
              <div class="row mt-3">
                <div class="col-auto mr-auto" id="divpoints_ta">
                  <div class="card  border-0">

                    <div class="card-body">
                      <div id="table" class="table">
                        <table class="table table-bordered table-responsive-md table-striped text-center shadow p-3 mb-5 bg-white rounded" id="table_points">
                          <tr>
                            <th class="text-center">Point Name</th>
                            <th class="text-center">Point Category</th>
                            <th class="text-center">Average Time (Minutes)</th>
                            <th class="text-center">Average Ranking</th>
                            <th class="text-center">Remove</th>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>



        <div class="mb-5  row justify-content-center">
          <button type="button" class="btn btn-primary btn-lg" onclick="formHandler()" style="width:250px;">Create Tour</button>
        </div>

      </form>

    </div>

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
          <h5 class="font-weight-bold text-uppercase mb-4">Footer Content</h5>
          <p>Here you can use rows and columns here to organize your footer content.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit amet numquam iure provident voluptate esse
            quasi, veritatis totam voluptas nostrum.</p>

          </div>
          <!-- Grid column -->

          <hr class="clearfix w-100 d-md-none">

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1">

            <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mb-4">About</h5>

            <ul class="list-unstyled">
              <li>
                <p>
                  <a href="#!">PROJECTS</a>
                </p>
              </li>
              <li>
                <p>
                  <a href="#!">ABOUT US</a>
                </p>
              </li>
              <li>
                <p>
                  <a href="#!">BLOG</a>
                </p>
              </li>
              <li>
                <p>
                  <a href="#!">AWARDS</a>
                </p>
              </li>
            </ul>

          </div>
          <!-- Grid column -->

          <hr class="clearfix w-100 d-md-none">

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1">

            <!-- Contact details -->
            <h5 class="font-weight-bold text-uppercase mb-4">Address</h5>

            <ul class="list-unstyled">
              <li>
                <p>
                  <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                </li>
                <li>
                  <p>
                    <i class="fas fa-envelope mr-3"></i> info@example.com</p>
                  </li>
                  <li>
                    <p>
                      <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                    </li>
                    <li>
                      <p>
                        <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                      </li>
                    </ul>

                  </div>
                  <!-- Grid column -->

                  <hr class="clearfix w-100 d-md-none">

                  <!-- Grid column -->
                  <div class="col-md-2 col-lg-2 text-center mx-auto my-4">

                    <!-- Social buttons -->
                    <h5 class="font-weight-bold text-uppercase mb-4">Follow Us</h5>

                    <!-- Facebook -->
                    <a type="button" class="btn-floating btn-fb">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <!-- Twitter -->
                    <a type="button" class="btn-floating btn-tw">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <!-- Google +-->
                    <a type="button" class="btn-floating btn-gplus">
                      <i class="fab fa-google-plus-g"></i>
                    </a>
                    <!-- Dribbble -->
                    <a type="button" class="btn-floating btn-dribbble">
                      <i class="fab fa-dribbble"></i>
                    </a>

                  </div>
                  <!-- Grid column -->

                </div>
                <!-- Grid row -->

              </div>
              <!-- Footer Links -->

              <!-- Copyright -->
              <div class="footer-copyright text-center py-3">© 2018 Copyright:
                <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
              </div>
              <!-- Copyright -->

            </footer>
            <!-- Footer -->


            <script >

            var query_category='select * from category';
            // var cat_ids=[];
            var time= parseInt(document.getElementById("tour_duration_time").value);
            document.getElementById("time_left_label").innerHTML="<b>Time left (minutes): "+time+"</b>";
            document.getElementById("time_left_label").value=time;





            function formHandler(){

              var sel_cat=document.getElementById("selected_tab").value;
              console.log(sel_cat);
              var json_data="";
              var ready_for_submit=true;
              var validation={};

              if (validateGeneralInputs()){
                if(sel_cat=="1"){
                  validation=validateByCategories();
                  console.log("formHandler: inside if category " + validation["json_data"]);
                }

                else{
                  validation=validateBypoints();
                  console.log("formHandler: inside else ( by points) : " +validation["json_data"]);
                }

                if (validation["validation_test"]){
                  console.log("formHandler: test is true, sending form: ");
                  console.log(validation["json_data"]);
                  document.tour_details_form.action='tour_map.php?json_data='+ validation["json_data"];
                  document.getElementById("tour_details_form").submit();
                }
              }
            }






            // var tab_data={"cat_tab_data":
            //   {"tab_id":"tab_by_categories","fill_div":"div_by_categories","clean_div":"div_by_points"},
            // "opt_tab_data":
            //   {"tab_id":"tab_by_points","fill_div":"div_by_points","clean_div":"div_by_categories"}
            // };
            //
            //
            // for (key in tab_data) {
            //   let tab_id=tab_data[key]["tab_id"];
            //   document.getElementById(tab_id).addEventListener("click",function(){
            //     let fill_div_id=tab_data[key]["fill_div"];
            //     let clean_div_id=tab_data[key]["clean_div"];
            //     console.log(tab_id + " , " +clean_div_id + " , "+ fill_div_id );
            //     document.getElementById(clean_div_id).innerHTML="";
            //     document.getElementById(fill_div_id).innerHTML="<select class='custom-select' id='categories' width=50px></select>";
            //     showCategory(fill_div_id);
            //   });
            //
            // }
            //
            // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");

            </script>


            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

          </body>
          </html>
