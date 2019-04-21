<!DOCTYPE html>
<html lang="en">

<head>

	<?php
		$year=date("Y");
	 	// $query="SELECT count(user_id) as Users,MONTH(Registeration date)
		// 			FROM user
		// 			WHERE user_type=1
		// 			GROUP BY YEAR(".$year."), MONTH(Registeration date)";

		?>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Dashboard</title>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700" rel="stylesheet">

	<link rel="stylesheet" href="assets/styles.css">

</head>

<body>

<?php include('navs.php'); ?>

	<div id="wrapper">

		<div class="content-area">
			<div class="container-fluid">
				<div class="main">


					<div class="row mt-5 mb-4">
						<div class="col-md-6">
							<div class="box">
								<div id="bar"> </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box">

								<div id="donut"> </div>
							</div>
						</div>
					</div>

					<div class="row mt-4 mb-4">
						<div class="col-md-6">
							<div class="box">
								<div id="area"> </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box">
								<div id="line"> </div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
	<script src="assets/data.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
	<script src="assets/scripts.js"></script>

	<script>

	</script>
</body>

</html>
