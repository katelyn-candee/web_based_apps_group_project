<html>
<head>
    <title>Restaurant</title>

<?php
	require_once  '../db/login.php';
	require_once "../usermanagement/User.php";
	require_once "../functions/star_rating.php";

	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
	
if(isset($_GET['restaurant'])){
	
	require_once "../restaurants/restaurant-details.php";
	
$restaurant_id = $_GET['restaurant'];

	$query = "SELECT f.food_item_id, f.restaurant_id, f.name, f.description, f.type, f.price, f.photo, rest.name AS r_name, ifnull(AVG(r.rating),0) AS rating, COUNT(r.rating) as num_reviews, rest.user_id AS r_user_id FROM food_item as f LEFT JOIN review as r ON f.food_item_id = r.food_item_id LEFT JOIN restaurant as rest on f.restaurant_id = rest.restaurant_id WHERE f.restaurant_id = $restaurant_id GROUP BY food_item_id;
	";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	$query_owner = "select user_id from restaurant where restaurant_id = $restaurant_id";
	
	$result_owner = $conn->query($query_owner);
	if(!$result_owner) die($conn->error);

	$rows = $result->num_rows;
?>
<div id='food-items-list' class='container-fluid card'>
	<div class='row'>
		<div class='col-sm-12'>
			<h3>Restaurant Menu</h3><br>
			
			
			<?php
				if(isset($_SESSION['user'])){
				$row_owner = $result_owner->fetch_array(MYSQLI_ASSOC);
				
				//get session user info
				$user = $_SESSION['user'];
				$user_id = $user->user_id;
				$user_roles = $user->getRoles();
				
				//check if review blongs to logged in user
				//or if logged in user is an administrator
				if($user_id == $row_owner['user_id']
						or $user_roles[0] == 'admin'){
				
				echo <<<_END
					<form action='../food/food-add.php' method='post' style='text-align:left'>
						<input type='hidden' name='restaurant_id' value='$restaurant_id'>
						<button>Add food item</button>
					</form>
				_END;
				}}
				?>
			
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
				<h4><?php echo $row['name']; ?></h4>
				<h5><?php echo $row['type']; ?></h5>
				<p><?php echo $row['description']; ?></p>
				<p>$ <?php echo $row['price']; ?></p>
				<p>
				<a href="../reviews/review-list.php?food_item=<?php echo $row['food_item_id']; ?>"><?php echo displayStarRating($row['rating'])." ".$row['num_reviews']." reviews"; ?></a></p>
				
				<?php
				if(isset($_SESSION['user'])){
				
				//get session user info
				$user = $_SESSION['user'];
				$user_id = $user->user_id;
				$user_roles = $user->getRoles();
				
				//check if review blongs to logged in user
				//or if logged in user is an administrator
				if($user_id == $row['r_user_id']
						or $user_roles[0] == 'admin'){
				
				echo "<a href='food-details.php?food_item_id=$row[food_item_id]'>Update/Delete this food item</a>";
				}}
				?>
			</div>
		</div>

<?php
	}
}else{
	
	require_once "../restaurants/restaurant-details.php"; 
	
		$query = "SELECT f.food_item_id, f.restaurant_id, f.name, f.description, f.type, f.price, f.photo, rest.name AS r_name, ifnull(AVG(r.rating),0) AS rating, COUNT(r.rating) as num_reviews, rest.user_id AS r_user_id FROM food_item as f LEFT JOIN review as r ON f.food_item_id = r.food_item_id LEFT JOIN restaurant as rest on f.restaurant_id = rest.restaurant_id GROUP BY food_item_id;
	";

	$result = $conn->query($query);
	if(!$result) die($conn->error);

	$rows = $result->num_rows;
?>
<div id='food-items-list' class='container-fluid card'>
	<div class='row'>
		<div class='col-sm-12'>
			<h3>Menu items for all restaurants</h3><br>
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
				<h4><?php echo $row['name']; ?></h4>
				<a href='../food/food-view.php?restaurant=<?php echo $row['restaurant_id']; ?>'>
				<h5><?php echo $row['r_name']; ?></h5></a>
				<h5><?php echo $row['type']; ?></h5>
				<p><?php echo $row['description']; ?></p>
				<p>$ <?php echo $row['price']; ?></p>
				<p>
				<a href="../reviews/review-list.php?food_item=<?php echo $row['food_item_id']; ?>"><?php echo displayStarRating($row['rating'])." ".$row['num_reviews']." reviews"; ?></a></p>
				
				<?php
				if(isset($_SESSION['user'])){
				
				//get session user info
				$user = $_SESSION['user'];
				$user_id = $user->user_id;
				$user_roles = $user->getRoles();
				
				//check if review blongs to logged in user
				//or if logged in user is an administrator
				if($user_id == $row['r_user_id']
						or $user_roles[0] == 'admin'){
				
				echo "<a href='food-details.php?food_item_id=$row[food_item_id]'>Update/Delete this food item</a>";
				}}
				?>
			</div>
		</div>
<?php
	}
}

	$conn->close();
?>
	</div>
	<br><br>

</body>
</html>
