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
		select * from restaurant
		where lower(type)='$category';
	";
	
	//display query results
	displayRestaurantResults($query);
	
} else if(isset($_GET['search']))	{
	
	//get search
	$search = $_GET['search'];
	
	//get restaurant data from database
	$query = "
		select * from restaurant
		where lower(name) like lower('%$search%')
			or lower(type) like lower('%$search%')
			or lower(description) like lower('%$search%')
			or lower(address) like lower('%$search%');
	";
	
	//display query results
	displayRestaurantResults($query);
	
} else	{
	
	//get restaurant data from database
	$query = "
		select * from restaurant
	";
	
	//display query results
	displayRestaurantResults($query);
}

function displayRestaurantResults($query)	{
	//import functions
	require_once "../db/login.php";
	
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
							<h3>$restaurant[name]</h3>
							<h4>$restaurant[type]</h4>
							<p>$restaurant[description]</p>
						</div>	
						<div class='col-sm-4'>
							<img src='$restaurant[photo]'></img>
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

