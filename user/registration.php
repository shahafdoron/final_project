<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta charset="utf-8">
<link href="/maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="/maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css" type="text/css">
<head>
	<?php
	include("../db_conn.php");
	if(isset($_POST['register'])) {
		$birthday=date("Y-m-d", strtotime($_REQUEST["birthday"]));
		$gender='';
		$date=date("Y-m-d");
		if ($_REQUEST["gender"]==0) {
			$gender='Male';s
		} else {
			$gender='Female';
		}
		$number= $_REQUEST['code'];
		$number.=$_REQUEST['number'];
		$insert_user_query="insert into user (first_name, last_name, email, phone, city, street_name, house_number, date_of_birth, gender, user_type, registration_date) VALUES ( '".$_REQUEST["first"]."','".$_REQUEST["last"]."' ,'".$_REQUEST["email"]."' ,'".$number."', '".$_REQUEST["city"]."','".$_REQUEST["street"]."','".$_REQUEST["house"]."' ,'".$birthday."','".$gender."' ,1 ,'".$date."' )";
		echo $insert_user_query;
		mysqli_query($conn,$insert_user_query);
		header("Location: user/homepage_user.php");
	}


	?>
	<title></title>
	<style media="screen">
	.divider-text {
		position: relative;
		text-align: center;
		margin-top: 15px;
		margin-bottom: 15px;
	}
	.divider-text span {
		padding: 7px;
		font-size: 12px;
		position: relative;
		z-index: 2;
	}
	.divider-text:after {
		content: "";
		position: absolute;
		width: 100%;
		border-bottom: 1px solid #ddd;
		top: 55%;
		left: 0;
		z-index: 1;
	}

	.btn-facebook {
		background-color: #405D9D;
		color: #fff;
	}
	.btn-twitter {
		background-color: #42AEEC;
		color: #fff;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="wrapper fadeInDown">
			<div class="card bg-light">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
				<article class="card-body mx-auto" style="max-width: 400px;">
					<h4 class="card-title mt-3 text-center">Create Account</h4>
					<p class="text-center">Get started with your free account</p>
					<p>
						<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
						<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
					</p>
					<p class="divider-text">
						<span class="bg-light">OR</span>
					</p>
					<form method="post" onsubmit="">
						<!--user name  -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-user"></i> </span>
							</div>
							<input name="first" class="form-control" placeholder="First name" type="text" required oninvalid="this.setCustomValidity('Please enter your first name')" oninput="setCustomValidity('')">
							<input name="last" class="form-control" placeholder="Last name" type="text" required oninvalid="this.setCustomValidity('Please enter your last name')" oninput="setCustomValidity('')">
						</div>

						<!--user email  -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
							</div>
							<input name="email" class="form-control" placeholder="Email address" type="email" required oninvalid="this.setCustomValidity('Please enter a valid email address')" oninput="setCustomValidity('')">
						</div>

						<!--user phone  -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
							</div>
							<select name="code" class="custom-select" style="max-width: 120px;" required oninvalid="this.setCustomValidity('Please choose a phone code')" oninput="setCustomValidity('')">
								<option selected="+972">+972</option>
								<option value="+971">+971</option>
								<option value="+198">+198</option>
								<option value="+701">+701</option>
							</select>
							<input name="number" class="form-control" placeholder="Phone number" type="text" required oninvalid="this.setCustomValidity('Please enter a valid phone number')" oninput="setCustomValidity('')">
						</div>

						<!--user address(city,street,house )  -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" > <i class="fa fa-building"></i> </span>
							</div>
							<input  name="city" class="form-control" placeholder="City" required oninvalid="this.setCustomValidity('Please enter your city name')" oninput="setCustomValidity('')"></span>
							<input name="street" class="form-control" placeholder="Street" required oninvalid="this.setCustomValidity('Please enter your street name')" oninput="setCustomValidity('')"></span>
							<input name="house" class="form-control" placeholder="Number" required oninvalid="this.setCustomValidity('Please enter your home number')" oninput="setCustomValidity('')"></span>
						</div>

						<!--user birthday and gander  -->
						<div class="form-group input-group">

							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fas fa-birthday-cake"></i></span>
							</div>
							<input name="birthday" class="form-control" type="date" max=<?php echo date("Y-m-d"); ?> required oninvalid="this.setCustomValidity('Please your birth date')" oninput="setCustomValidity('')">

							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fas fa-venus-mars"></i></span>
							</div>
							<select name="gender" class="custom-select" style="max-width: 100px;" required oninvalid="this.setCustomValidity('Please choose your gender')" oninput="setCustomValidity('')">
								<option value="" disabled selected hidden>Gender</option>
								<option value="0">Male</option>
								<option value="1">Female</option>
							</select>
						</div>

						<!--user password  -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input name="password" class="form-control" placeholder="Create password" type="password" required oninvalid="this.setCustomValidity('Please enter your password')" oninput="setCustomValidity('')">
						</div>

						<div class="form-group">
							<button type="submit" name="register" class="btn btn-primary btn-block"> Create Account </button>
						</div>

						<p class="text-center">Have an account? <a href="../index.php">Log In</a> </p>
					</form>
				</article>
			</div>

		</div>
	</div>

	<br><br>

</body>
</html>
