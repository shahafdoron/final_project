<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("../db_conn.php");
  $tour_id=$_REQUEST['tour_id'];
  $remaining_ticket=$_REQUEST['remaining'];
  $tour_details_query="select guided_tour_registration.guided_tour_id AS tour_id,guided_tour_registration.registered_tourist_id AS user_id, concat(user.first_name ,' ',user.last_name) as user_name,guided_tour_registration.subscribers as number_tickets from guided_tour_registration,user where guided_tour_id=".$tour_id." and guided_tour_registration.registered_tourist_id=user.user_id";
  // echo $tour_details_query;
  $tour_list=extract_data_to_json($tour_details_query);
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <title></title>
  <u>
  </u>
</head>
<script src="../user/script.js">  </script>
<body onload='create_table(`<?php print_r ($tour_list);?>` ,`user_table`)'>

  <?php include('navs.php'); ?>

  <div class="container border shadow p-3 mb-5 bg-white rounded">



    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="analytics.php">Statistical Analysis</a>
      </li>
      <li class="breadcrumb-item"><a href="edit_guided.php" >Guided Tours Administration</a>
      </li>
      <li class="breadcrumb-item active"><a href="edit_existing_guided.php">Edit Existing Guided Tours</a>
      </li>
    </li>
    <li class="breadcrumb-item active"><a>Tour <?php echo $tour_id; ?> Participants List</a>
    </li>
  </ol>


  <div class="container shadow p-3 mb-5 bg-white rounded border">
    <h2 style="text-align: center;" ><u>Tour <?php echo $tour_id; ?> Participants List</u></h2><br>

    <div id=container class="container" >
      <div class="card  border-0">

        <div class="card-body">
          <div id="table" class="table" >
            <table class="table table-bordered table-responsive-md table-striped text-center shadow p-3 mb-5 bg-white rounded" id="user_table" >
              <tr>
                <th class="text-center">User ID</th>
                <th class="text-center">User Name</th>
                <th class="text-center">Number of Tickets</th>
                <th class="text-center">Remove</th>
              </tr>
            </table>
          </div>
        </div>
        <h3 align='center' style='color: red;'>Number Of Remaining Tickets: <?php echo $remaining_ticket;?></h3>
      </div>
    </div>
  </div>
</div>
<script>
function create_table(tour_list,table_id){
  tour_list=JSON.parse(tour_list);
  for (var i = 0; i < tour_list.length; i++) {
    var tr_id="tr_u"+tour_list[i].user_id+":"+tour_list[i].tour_id+":"+tour_list[i].number_tickets;
    var ht=' <td id='+tour_list[i].user_id+' value='+tour_list[i].user_id+'>'+tour_list[i].user_id+'</td><td class="pt-3-half" >'+tour_list[i].user_name+'</td><td class="pt-3-half" >'+tour_list[i].number_tickets+'</td>';
    ht+='<td><span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="remove(\''+tr_id+'\',\'remove_participant\');">Remove</button></span></td>';
    addElement(table_id,"tr",tr_id,ht);
  }
 // onclick="removeElement( \''+tr_id+'\' ,\''+select_points_id+'\', \''+j_point["p_id"]+'\',\'table\','+step+');"
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
