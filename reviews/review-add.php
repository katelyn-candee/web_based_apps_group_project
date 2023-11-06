<?php
//import files
include "../php-functions/sanitize.php";

// set db connection variables and credentials
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "food_app";

// create db connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$food_item_id = 4;

// get food item from db
$sql = "
	select name
	from food_items
	where id=$food_item_id;
	
	";
$result = $conn->query($sql);

$food_item = array();
if ($result->num_rows > 0) {
    $food_item = $result->fetch_assoc();
}

//set form submission variables
if(isset($_POST["review-rating"]))	{
	$review_rating = $_POST["review-rating"];
}
if(isset($_POST["review-title"]))	{
	$review_title = sanitizeString($_POST["review-title"]);
}
if(isset($_POST["review-description"]))	{
	$review_description = sanitizeString($_POST["review-description"]);
}

?>

<html>
	<head>
		<title>Add Review</title>
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
					<h2>Tell us what you think about <?php echo $food_item['name']; ?> </h2>
				</div>	
			</div>
			<div class='row'>
				<div class='col-sm-12'>
					<form method='post' action='food-item-reviews.php'>
						<div>
							Rating: 
							<input type ="radio" name='rating' value ='1'> 1 star
							<input type ="radio" name='rating' value ='2'> 2 stars
							<input type ="radio" name='rating' value ='3'> 3 stars
							<input type ="radio" name='rating' value ='4'> 4 stars
							<input type ="radio" name='rating' value ='5'> 5 stars
							<br><br>
						</div>
						<div>
							Review title: <input type='text' name='review-title'></input><br><br>
							Review description: <input type='text'></input><br><br>
						</div>
							<input type='submit' value='Add review'></input>
					</form>
				</div>
			</div>
		</div
	</body>
</html>