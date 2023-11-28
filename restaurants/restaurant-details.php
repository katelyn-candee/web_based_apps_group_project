<html>
	<head>
		<title>Reviews</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="food-style.css"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	</head>
	</body>
		<div class='container-fluid' >
			<div class='row'>
				<div class='col-sm-12'>
					<h1>Food Review App</h1>
				</div>	
			</div>
		</div>

<?php

//check if restaurant id was passed
if(isset($_GET['restaurant']))	{

	//get restaurant
	$restaurant_id = $_GET['restaurant'];
	
	//get restaurant data from database
	$query = "
		with restaurant_rating as (
			select 
				f.restaurant_id,
				round(avg(r.rating),0) as avg_rating,
				count(distinct r.review_id) as num_reviews
			from review r
			left join food_item f
				on r.food_item_id = f.food_item_id
			group by f.restaurant_id
		   )
		   
		select * from restaurant r
		left join restaurant_rating rr
			on r.restaurant_id = rr.restaurant_id
		where r.restaurant_id='$restaurant_id';
	";
	
	//display query results
	displayRestaurantResults($query);
	
}

function displayRestaurantResults($query)	{
	//import functions
	require_once "../db/login.php";
	require_once "../functions/star_rating.php";
	
	//create database connection
	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);

	$rows = $result->num_rows;
	
	if($rows>0)	{
	
		//display restaurants
		for ($i=0; $i<$rows; $i++)	{
			$restaurant = $result->fetch_array(MYSQLI_ASSOC);

			echo <<<_END
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-sm-8'>
							<h3>$restaurant[name]</h3></a>
							<h4>$restaurant[type]</h4>
							<p>$restaurant[description]</p>
							<a href='../food/food-view.php?restaurant=$restaurant[restaurant_id]'><h4>View all food items</h4></a>
			_END;
			
			echo	'<p>'.displayStarRating($restaurant['avg_rating']).' '.$restaurant['num_reviews'].' reviews</p>';
			
			echo <<<_END
						</div>
						<div class='col-sm-4'>
							<p>$restaurant[address]<br>
							$restaurant[phone]<br>
							$restaurant[website]</p>
						</div>
					</div> 
				</div>
			_END;
			
		}
	} else	{
		
		echo <<<_END
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-sm-12'>
							<p>No results</p>
						</div>	
					</div>
				</div>
		_END;
	}
	
	//close database connection
	$conn->close();
}

?>

	</body>
</html>

