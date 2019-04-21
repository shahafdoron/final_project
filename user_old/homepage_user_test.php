<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" href="style/homeStyle.css" type="text/css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script>

function callFrame(url)
{
	// make_str_date();

	document.getElementById('iframe1').src = url;


  // +"?date="+make_str_date();
}
</script>

</head>
<body>
<div class="container">
	<div >
  <a href="homepage_user.php">Home</a>
  <a onclick="callFrame('points_info.php')">Infomation about Points</a>
  <a onclick="callFrame('enter_dates_guided.php')">Guided Tours</a>
  <a onclick="callFrame('events.php')">Make your own Tour</a>
  <a onclick="callFrame('events.php')">Contact</a>
</div>
<div class="embed-responsive embed-responsive-1by1" >
  <iframe id="iframe1" class="embed-responsive-item" src="" frameborder="0";></iframe>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
