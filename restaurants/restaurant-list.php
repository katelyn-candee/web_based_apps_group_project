<html>
	<head>
		<title>Restaurants</title>

<?php 
require_once "../style/header.php";
//check if restaurant category was passed
if(isset($_GET['category']))	{

	//get category
	$category = $_GET['category'];
	
	//get restaurant data from database
	$query = "
		with restaurant_rating as (
			select 
				f.restaurant_id,
				coalesce(round(avg(r.rating),0),0) as avg_rating,
				coalesce(count(distinct r.review_id),0) as num_reviews
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
	
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-12">
					<h2 style='text-align:left;margin-left:10%;'>Results for "$category"</h2>
				</div>	
			</div>
		</div>
	_END;
	
	//display query results
	displayRestaurantResults($query, $hn, $un, $pw, $db);
	
} else if(isset($_POST['search']))	{
	
	//get search
	$search = $_POST['search'];
	
	//get restaurant data from database
	$query = "
		with restaurant_rating as (
			select 
				f.restaurant_id,
				coalesce(round(avg(r.rating),0)) as avg_rating,
				coalesce(count(distinct r.review_id)) as num_reviews
			from review r
			left join food_item f
				on r.food_item_id = f.food_item_id
			group by f.restaurant_id
		   )
		   
		select r.*, avg_rating, num_reviews from restaurant r
		left join restaurant_rating rr
			on r.restaurant_id = rr.restaurant_id
		where lower(r.name) like lower('%$search%')
			or lower(r.type) like lower('%$search%')
			or lower(r.description) like lower('%$search%')
			or lower(r.address) like lower('%$search%');
	";
	
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-12">
					<h2 style='text-align:left;margin-left:10%;'>Results for "$search"</h2>
				</div>	
			</div>
		</div>
	_END;
	
	//display query results
	displayRestaurantResults($query, $hn, $un, $pw, $db);
	
} else	{
	
	//get restaurant data from database
	$query = "
		with restaurant_rating as (
			select 
				f.restaurant_id,
				coalesce(round(avg(r.rating),0)) as avg_rating,
				coalesce(count(distinct r.review_id)) as num_reviews
			from review r
			left join food_item f
				on r.food_item_id = f.food_item_id
			group by f.restaurant_id
		   )
		   
		select r.*, avg_rating, num_reviews from restaurant r
		left join restaurant_rating rr
			on r.restaurant_id = rr.restaurant_id
	";
	
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-12">
					<h2 style='text-align:left;margin-left:10%;'>Results</h2>
				</div>	
			</div>
		</div>
	_END;
	
	//display query results
	displayRestaurantResults($query, $hn, $un, $pw, $db);
}

function displayRestaurantResults($query, $hn, $un, $pw, $db)	{
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
						<div class='col-sm-8'>
							<a href='../food/food-view.php?restaurant=$restaurant[restaurant_id]'><h3>$restaurant[name]</h3></a>
							<h4>$restaurant[type]</h4>
							<p>$restaurant[description]</p>
							
			_END;	
			
			if ($restaurant['num_reviews'] > 0) {
			
				echo	"<a href='../food/food-view.php?restaurant=". $restaurant['restaurant_id'] ."#food-items-list'><p>". displayStarRating($restaurant['avg_rating']) ." ". $restaurant['num_reviews'] ." food item reviews</p></a>";	
			} else {
				echo "<a href='../food/food-view.php?restaurant=$restaurant[restaurant_id]'><p>0 food item reviews</p></a>";
			}
			
			echo <<<_END
							<p>$restaurant[address]<br>
							$restaurant[phone]<br>
							$restaurant[website]</p>
						</div>
						<div class='col-sm-4'>
							<p><br><a href='../food/food-view.php?restaurant=$restaurant[restaurant_id]'><img src='../$restaurant[photo]'></img></a></p>
							
						</div>
					</div> 
				</div>
			_END;
			
		}
	} else	{
		
		echo <<<_END
				<div class='container-fluid' style='margin-left:10%'>
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

