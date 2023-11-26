<html>
	<head>
		<title>Restaurants</title>
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
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-12">
					<h2>Results</h2>
				</div>	
			</div>
		</div>

<?php


//check if restaurant category was passed
if(isset($_GET['category']))	{

	//get category
	$category = $_GET['category'];
	
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
		where lower(r.type) like '%$category%';
	";
	
	//display query results
	displayRestaurantResults($query);
	
} else if(isset($_POST['search']))	{
	
	//get search
	$search = $_POST['search'];
	
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
		where lower(r.name) like lower('%$search%')
			or lower(r.type) like lower('%$search%')
			or lower(r.description) like lower('%$search%')
			or lower(r.address) like lower('%$search%');
	";
	
	//display query results
	displayRestaurantResults($query);
	
} else	{
	
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
							<a href='restaurant-details.php?restaurant=$restaurant[restaurant_id]'><h3>$restaurant[name]</h3></a>
							<h4>$restaurant[type]</h4>
							<p>$restaurant[description]</p>
			_END;
			
			echo	'<p>'.displayStarRating($restaurant['avg_rating']).' '.$restaurant['num_reviews'].' reviews</p>';
			
			echo <<<_END
						</div>
						<div class='col-sm-4'>
							<a href='restaurant-details.php?restaurant=$restaurant[restaurant_id]'><img src='$restaurant[photo]'></img></a>
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

