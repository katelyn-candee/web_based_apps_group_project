<?php
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
	</head>
	</body>
		<h1>Food Review App</h1>
		<h2>Reviews for <?php echo $food_item['name']; ?> </h2>
        <?php foreach ($reviews as $review) { ?>
            <div>
				<div>
					<h3> <?php echo $review['title']; ?> </h3>
					<p> <?php echo $review['description']; ?></p>
				</div>
				<div>
					Rating: <?php echo $review['rating']; ?>
				</div>
				<div>
					<?php echo $review['first_name']; ?><br>
					<?php echo $review['city'].', '.$review['state']; ?>
				</div>
				<div>
					<a href='review-update.php'>Update</a>
					<a href='food-item-reviews.php'>Delete</a>
				</div>
            <div>
        <?php } ?>
		</div>
		</div>
		<a href='review-add.php'><button>Add a review</button></a>
		<div>
	</body>
</html>

