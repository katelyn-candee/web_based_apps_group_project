<html>
<head>
    <title>Food App Reviews</title>

<?php
	require_once  '../db/login.php';
	require_once "../usermanagement/User.php";
	require_once "../functions/star_rating.php";

	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
	
if(isset($_GET['restaurant'])){
	
	require_once "../restaurants/restaurant-details.php";
	
$restaurant_id = $_GET['restaurant'];

	$query = "SELECT f.food_item_id, f.restaurant_id, f.name, f.description, f.type, f.price, f.photo, rest.name AS r_name, ifnull(AVG(r.rating),0) AS rating, COUNT(r.rating) as num_reviews FROM food_item as f LEFT JOIN review as r ON f.food_item_id = r.food_item_id LEFT JOIN restaurant as rest on f.restaurant_id = rest.restaurant_id WHERE f.restaurant_id = $restaurant_id GROUP BY food_item_id;
	";

	$result = $conn->query($query);
	if(!$result) die($conn->error);

	$rows = $result->num_rows;
?>
<div id='food-items-list' class='container-fluid card'>
	<div class='row'>
		<div class='col-sm-12'>
			<h3>Food items</h3><br>
			<form action='food-add.php' method='post' style='text-align:left'>
				<button>Add food item</button>
			</form>
			<br>
		</div>
	</div>
	

<?php
	for($j=0; $j<$rows; ++$j){
		$row = $result->fetch_array(MYSQLI_ASSOC);
?>
		<div class='row card'>
			<div class='col-sm-6'>
				<img src="../<?php echo $row['photo']; ?>"><br>
			</div>
			<div class='col-sm-4' style='text-align:left'>
				<a href="food-details.php?food_item_id=<?php echo $row['food_item_id']; ?>">
				<h4><?php echo $row['name']; ?></h4></a>
				<h5><?php echo $row['type']; ?></h5>
				<p><?php echo $row['description']; ?></p>
				<p>$ <?php echo $row['price']; ?></p>
				<p>
				<a href="../reviews/review-list.php?food_item=<?php echo $row['food_item_id']; ?>"><?php echo displayStarRating($row['rating'])." ".$row['num_reviews']." reviews"; ?></a></p>
			</div>
		</div>

<?php
	}
}else{
		$query = "SELECT f.food_item_id, f.restaurant_id, f.name, rest.name AS 'r_name', f.description, f.type, f.price, f.photo, ifnull(AVG(r.rating),0) AS 'rating' FROM food_item as f left JOIN review as r ON f.food_item_id = r.food_item_id join restaurant as rest on f.restaurant_id = rest.restaurant_id 
		GROUP BY food_item_id, restaurant_id, name, description, type, price, photo, r_name;";

	$result = $conn->query($query);
	if(!$result) die($conn->error);

	$rows = $result->num_rows;
?>
	
	<form action='food-add.php' method='post'>
		<button style="padding: 10px 20px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">ADD FOOD ITEM</button>
	</form>
	
<?php
	for($j=0; $j<$rows; ++$j){
		$row = $result->fetch_array(MYSQLI_ASSOC);
?>

		<pre>
			<img src="<?php echo $row['photo']; ?>" alt="Food Image"><br>
			<strong>Restaurant:<a href="../restaurants/restaurant-details.php?restaurant=<?php echo $row['restaurant_id']; ?>"><?php echo $row['r_name']; ?></a></strong><br>
			<strong>Name:<a href="food-details.php?food_item_id=<?php echo $row['food_item_id']; ?>"><?php echo $row['name']; ?></a></strong><br>
			<strong>Type: <?php echo $row['type']; ?></strong><br>
			<strong>Price: $ <?php echo $row['price']; ?></strong><br>
			<strong>Average Rating: <a href="../reviews/review-list.php?food_item=<?php echo $row['food_item_id']; ?>"><?php echo displayStarRating($row['rating']); ?></a></strong>
		</pre>

<?php
	}
}

	$conn->close();
?>
	</div>
	<br><br>

</body>
</html>
