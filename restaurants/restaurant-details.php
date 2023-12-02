<html>
	<head>
		<title>Restaurant Details</title>

<?php
require_once "../style/header.php";

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
	displayRestaurantResults($query, $hn, $un, $pw, $db);
	
}

function displayRestaurantResults($query, $hn, $un, $pw, $db)	{
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
				<div class='container-fluid card' style='text-align:left'>
					<div class='row'>
						<div class='col-sm-12'>
							<h2 style='text-align:left'>$restaurant[name]</h2></a>
							<h4>$restaurant[type]</h4>
					<div class='row'>
						<div class='col-sm-6'>
							<p><a href='restaurant-details.php?restaurant=$restaurant[restaurant_id]'><img src='../$restaurant[photo]' style='height:300px'></img></a></p>
						</div>
						<div class='col-sm-6'>
							<p>$restaurant[description]</p>
							<p>$restaurant[address]<br>
							$restaurant[phone]<br>
							$restaurant[website]</p>
						
			_END;
			
			echo	'<a href="#food-items-list"><p>'.displayStarRating($restaurant['avg_rating']).' '.$restaurant['num_reviews'].' food item reviews</p></a>';
			
			echo <<<_END
						</div>
					</div>
						<div class='col-sm-4'>
							
							
						</div>
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

