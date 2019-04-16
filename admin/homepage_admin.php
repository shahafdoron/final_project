
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../user/style/homeStyle.css" type="text/css">
<script>
function callFrame(url)
{

	document.getElementById('iframe1').src = url;
}
</script>

</head>
<body>

<div class="sidenav">
  <a href="homepage_admin.php">Home</a>
  <a onclick="callFrame('points_info.php')">Infomation about Points</a>
  <a onclick="callFrame('edit_guided.php')">Guided Tours</a>
  <a onclick="callFrame('analytics.php')">Statistical Analysis </a>
</div>

<div class="main">
  <iframe id="iframe1" class="iframe" src="" frameborder="0";></iframe>
</div>

</body>
</html>
