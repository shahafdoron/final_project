<!DOCTYPE html>
<html lang="en">

<head>

	<?php
	include("../db_conn.php");
	// $count_tour_points_category_query = "select  category.cat_name as name,COUNT(point_of_interest.point_id) as num\n"
	// . "from point_of_interest,category,tour_points_of_interest\n"
	// . "WHERE point_of_interest.category_id=category.category_id AND category.category_id NOT IN (SELECT category_id from category where category_id=3 or category_id=7)\n"
	// . "and tour_points_of_interest.point_id=point_of_interest.point_id\n"
	// . "GROUP by category.cat_name";
	// echo "<br><br><br>";
	// echo $count_tour_points_category_query;
	// $count_tour_points_category=json_decode(extract_data_to_json($count_tour_points_category_query),true);
	// 	echo "<br><br><br>";
	// 	print_r($count_tour_points_category);

	$count_user_data=count_user();
	$cate_count_data=category_count();
	$count_participants_tour=count_participants_tour();
	$count_tour_points_category=count_tour_points_category();


	function count_tour_points_category(){
		$count_tour_points_category_query = "select  category.cat_name as name,COUNT(point_of_interest.point_id) as num\n"
    . "from point_of_interest,category,tour_points_of_interest\n"
    . "WHERE point_of_interest.category_id=category.category_id AND category.category_id NOT IN (SELECT category_id from category where category_id=3 or category_id=7)\n"
    . "and tour_points_of_interest.point_id=point_of_interest.point_id\n"
    . "GROUP by category.cat_name";
		$count_tour_points_category=json_decode(extract_data_to_json($count_tour_points_category_query),true);
		$data=array();
		$category=array();
		$number_points=array();
		$size=sizeof($count_tour_points_category);
		for ($i=0; $i < $size; $i++) {
			array_push($category,$count_tour_points_category[$i]['name']);
			array_push($number_points,intval($count_tour_points_category[$i]['num']));
		}
		array_push($data,$category,$number_points);
		return $data;

	}


	function count_user(){
		$count_users_query = "select date_format(registration_date, '%b %Y') as date, count(user_id) as count
		from user
		where user_type=1
		group by date
		order by date";
			echo $count_users_query;
		$count_users=json_decode(extract_data_to_json($count_users_query),true);

		$data=array();
		$dates=array();
		$count=array();
		$size=sizeof($count_users);
		$total=0;
		if($size<=12){
			for ($i=0; $i < $size; $i++) {
				array_push($count,intval($count_users[$i]['count']));
				array_push($dates,$count_users[$i]['date']);
				$total=$total+intval($count_users[$i]['count']);

			}
		}else {
			for ($i=$size-12; $i < $size; $i++) {
				array_push($count,intval($count_users[$i]['count']));
				array_push($dates,$count_users[$i]['date']);
				$total=$total+intval($count_users[$i]['count']);
			}

		}
		array_push($data,$dates,$count,$total);

		return $data;
	}
	function count_participants_tour(){
		$count_participants_tour_query =  "select date_format(planned_date_and_time_tour, '%b %Y') as date,(case when tour_type=1 THEN '1' Else '0' end) as tour_type, sum(participants) as count
		from tour
		group by date,tour_type
		order by date,tour_type";

		$count_participants_tour=json_decode(extract_data_to_json($count_participants_tour_query),true);
		$js=[];
		for ($i=0; $i <sizeof($count_participants_tour) ; $i++) {
			if (array_key_exists($count_participants_tour[$i]['date'],$js)) {
				$js[$count_participants_tour[$i]['date']][intval($count_participants_tour[$i]['tour_type'])]=intval($count_participants_tour[$i]['count']);
			} else {
			$js[$count_participants_tour[$i]['date']]=array_fill(0,2,0);
			$js[$count_participants_tour[$i]['date']][intval($count_participants_tour[$i]['tour_type'])]=intval($count_participants_tour[$i]['count']);
			}
		}
		$dates=array();
		$count_guided=array();
		$count_inde=array();
		$data=array();
		foreach ($js as $key => $value) {
			array_push($dates,$key);
			array_push($count_guided,$value[0]);
			array_push($count_inde,$value[1]);
		}
			array_push($data,$dates,$count_guided,$count_inde);
			return $data;
	}
	function category_count(){
		$category_count_query='select TABLE1.category,IFNULL(TABLE1.Count_guided,0) AS guided_count ,IFNULL(TABLE2.Count_inde,0) AS independent_count
		FROM

		(select category.cat_name as category,sum(tour.participants) as Count_guided,(case when tour.tour_type=2 THEN "Guided" Else "indepentent" end) as tour_type
		from category,tour_categories,tour
		where  tour_categories.tour_id=tour.tour_id and tour.tour_type=2 and category.category_id=tour_categories.category_id and category.category_id NOT IN (select category_id FROM category
		WHERE category_id=3 or category_id=7)
		group by tour.tour_type,category.cat_name
		ORDER by category.cat_name) as TABLE1

		LEFT OUTER JOIN

		(select category.cat_name as category,sum(tour.participants) as Count_inde,(case when tour.tour_type=2 THEN "Guided" Else "indepentent" end) as tour_type
		from category,tour_categories,tour
		where  tour_categories.tour_id=tour.tour_id and tour.tour_type=1 and category.category_id=tour_categories.category_id and category.category_id NOT IN (select category_id FROM category
		WHERE category_id=3 or category_id=7)
		group by tour.tour_type,category.cat_name
		ORDER by category.cat_name) AS TABLE2

		ON TABLE1.category = TABLE2.category

		UNION

		select TABLE2.category,IFNULL(TABLE1.Count_guided,0) AS guided_count, IFNULL(TABLE2.Count_inde,0) AS independent_count

		FROM
		(select category.cat_name as category,sum(tour.participants) as Count_guided,(case when tour.tour_type=2 THEN "Guided" Else "indepentent" end) as tour_type
		from category,tour_categories,tour
		where  tour_categories.tour_id=tour.tour_id and tour.tour_type=2 and category.category_id=tour_categories.category_id and category.category_id NOT IN (select category_id FROM category
		WHERE category_id=3 or category_id=7)
		group by tour.tour_type,category.cat_name
		ORDER by category.cat_name) as TABLE1

		RIGHT OUTER JOIN

		(select category.cat_name as category,sum(tour.participants) as Count_inde,(case when tour.tour_type=2 THEN "Guided" Else "indepentent" end) as tour_type
		from category,tour_categories,tour
		where  tour_categories.tour_id=tour.tour_id and tour.tour_type=1 and category.category_id=tour_categories.category_id and category.category_id NOT IN (select category_id FROM category
		WHERE category_id=3 or category_id=7)
		group by tour.tour_type,category.cat_name
		ORDER by category.cat_name) AS TABLE2

		ON TABLE1.category = TABLE2.category';
		$category_count=json_decode(extract_data_to_json($category_count_query),true);
		$cate=array();
		$count_guided=array();
		$count_inde=array();
		$data=array();
		for ($i=0; $i <sizeof($category_count) ; $i++) {
			array_push($cate,$category_count[$i]['category']);
			array_push($count_guided,$category_count[$i]['guided_count']);
			array_push($count_inde,$category_count[$i]['independent_count']);
		}
		array_push($data,$cate,$count_guided,$count_inde);
		return $data;

	}
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

	<div class="container border shadow p-3 mb-5 bg-white rounded">
		<ol class="breadcrumb">
			
			<li class="breadcrumb-item active">
				<a >Statistical Analysis</a>
			</li>
		</ol>
		<h2 style="text-align: center;"><u>Statistical Analysis</u></h2><br>
		<div class="container border shadow p-3 mb-5 bg-white rounded">
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
	</div>
		</div>
	<script>
	var cate_count=<?php echo json_encode($cate_count_data); ?>;
	var count_user=<?php echo json_encode($count_user_data); ?>;
	var count_participants_tour=<?php echo json_encode($count_participants_tour); ?>;
	var count_tour_points_category=<?php echo json_encode($count_tour_points_category); ?>;
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="assets/data.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
<script src="assets/scripts.js"></script>

<script>

</script>
</body>

</html>
