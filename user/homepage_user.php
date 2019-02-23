<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/homeStyle.css" type="text/css">
<script>
//
// function make_str_date(){
// var dateNow = new Date();
// var hour=dateNow.toLocaleTimeString();
//  var month = dateNow.getMonth();
//  var day = dateNow.getDate();
//  var year = dateNow.getFullYear();
//
//
// str_date="";
// if(day <10){
// 		if((month+1)<10)
// 			str_date+=year +"-0"+(month+1)+"-0"+day ;
// 		else
// 			str_date+=year +"-"+(month+1)+"-0"+day ;
// }
// else{
// 		if((month+1)<10)
// 		str_date+=year +"-0"+(month+1)+"-"+day ;
//
// 		else
// 		str_date+=year +"-"+(month+1)+"-"+day ;
//
// }
// return str_date;
//
// }
function callFrame(url)
{
	// make_str_date();
	document.getElementById('iframe1').src = url;
  // +"?date="+make_str_date();
}
</script>

</head>
<body>

<div class="sidenav">
  <a href="homepage_user.php">Home</a>
  <a onclick="callFrame('events.php')">Infomation about Points</a>
  <a onclick="callFrame('enter_dates_guided.php')">Guided Tours</a>
  <a onclick="callFrame('events.php')">Make your own Tour</a>
  <a onclick="callFrame('events.php')">Contact</a>
</div>

<div class="main">
  <iframe id="iframe1" class="iframe" src="" frameborder="0";></iframe>
</div>

</body>
</html>
