
function callAjax(func,url){
  var request = new XMLHttpRequest();
  request.open("GET",url);
  request.onreadystatechange = function() {
    if ((request.readyState==4) & (request.status==200)){
      var json_data=JSON.parse(request.responseText);
      console.log(json_data);
      func(json_data);
        }
    }
    request.send();
  }



function concatenateCategories(json_data){

  var el=document.getElementById("categories");
  var txt="<option selected disabled hidden>Choose category</option>";
  var x = document.getElementById("categories");
  for (var i = 0; i < json_data.length; i++){
    txt+="<option id='"+json_data[i].category_ID+"' >"+json_data[i].name+"</option>";
  }
  el.innerHTML=txt;
  el.addEventListener("change",showCategoryPoints);
}

function showCategoryPoints(){
  var cat=document.getElementById("categories");
  var cat_id=cat.options[cat.selectedIndex].id;
  var cat_name=cat.options[cat.selectedIndex].value;
  var query="SELECT * FROM point_of_interest,category WHERE point_of_interest.category_ID=category.category_ID AND category.name='"+cat_name+"'";
  callAjax(concatenatePoints,'file.php?query='+query);
}

function concatenatePoints(json_data){
  var points_div=document.getElementById("points");
  points_div.innerHTML="<p>"+JSON.stringify(json_data)+"</p>";
}



function concatenateGuidedTours(json_data){

  var counter=1;
  var txt="";
  for (i=0;i<json_data.length;i++){
    txt+="<form method='POST' action='guided_info_book.php?tour="+JSON.stringify(json_data[i])+"'>";
    txt+="<div class='row' style='border-style: solid; border-width: 1px; padding: 1px 4px'>";
    txt+="<table style='width: 100%'>";
    txt+="<tr>";
    txt+="<td style='text-align: center; text-decoration: underline;'>Tour number "+counter+"</td>";
    txt+="<td style='text-align: center'>Date : "+json_data[i].tour_date+", Hours: "+json_data[i].Start_time+"-"+json_data[i].Finish_Time+"</td></tr>";
    txt+="<tr><td>&nbsp;</td>";
    txt+="<td style='text-align: center'>Cost: "+json_data[i].tour_cost+"₪ <br><br>Remaining tickets: "+json_data[i].remaining_tickets+" Tickets</td></tr></table>";
    txt+="<div class='btn' style='text-align: center'><input name='Submit1' type='submit' value='More information and booking' ></div>";
    txt+="</div><div class='clear'></div></form>";
    counter+=counter;

  }
    document.getElementById("container").innerHTML=txt;
}


//   <select id="categories" onchange="showCategories()">
//     <option value="">Choose an option:</option>
//     <option value="customers">Customers</option>
//     <option value="products">Products</option>
//     <option value="suppliers">Suppliers</option>
//   </select>

//jquery :

// $.ajax({
//   type:"GET",
//   url:"file.php",
//   async: true,
//   data:{},
//   dataType: "JSON",
//   success: function(data) {
//       $("#main").html(data);
//   },
//   error: function()
// });
//
// //shortcut :
// $.get({
//   url:'file.php',
//   dataType:'JSON',
//   success: function(data){
//     $("#main").html(data);
//   }
// });


// json_encode:
//$assoc=array("a"=>1,"b"=>2,"c"=>3);
//json_encode($assoc); -----> this is the most recomand implementation ----> result will be: '{"a":1,"b":2,"c":300}'
// also can : $assoc=array("a","b","c"3);
//            json_encode($assoc,JSON_FORCE_OBJECT); ------> result  wil bee: '{0:"a",1:"b",2:"c"}'
