<?php
// import functions
include "../php-functions/star_rating.php";

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

// get reviews from db
$sql = "
	select
		r.*,
		u.first_name,
		u.last_name,
		u.city,
		u.state
	from reviews as r
	left join users as u
		on r.user_id = u.id
	where food_item_id=$food_item_id;
	
	";
$result = $conn->query($sql);

$reviews = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();

?>
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
					<h2>Reviews for <?php echo $food_item['name']; ?> </h2>
				</div>	
			</div>
			<div class='row'>
				<div class='col-sm-12'>
					<a href='review-add.php'><button>Add a review</button></a>
				</div>
			</div>
		</div>
        <?php foreach ($reviews as $review) { ?>
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-sm-12'>
						<h2><?php echo displayStarRating($review['rating']); ?></h2>
						<h3> <?php echo $review['title']; ?> </h3>
						<p> <?php echo $review['description']; ?></p>
					</div>	
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<?php echo $review['first_name']; ?><br>
						<?php echo $review['city'].', '.$review['state']; ?>
					</div>
					<div class='col-sm-6'>
						<br><a href='review-update.php'>Update</a>
						<a href='food-item-reviews.php'>Delete</a>
					</div>
				</div> 
			</div>
        <?php } ?>

	</body>
</html>

