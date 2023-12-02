<html>
	<head>
		<title>Add Review</title>

<?php
//import functions
require_once "../style/header.php";
require_once "../db/login.php";
require_once "../db/sanitize.php";
require_once "../usermanagement/User.php";

$page_roles = array("admin", "member");

require_once "../usermanagement/checksession.php";

//for development until we learn how to get user info
//$member_id = 4;

//create database connection
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

//check if food item id was passed and user is logged in
if(isset($_GET['food_item']) and isset($_SESSION['user']))	{

	//get user id
	$user = $_SESSION['user'];
	$user_id = $user->user_id;
	
	//get user member info from database
	$query = "
		select *
		from member
		where user_id='$user_id';
	";
	
	$result = $conn->query($query);
	
	if(!$result) die($conn->error);	
	$member = $result->fetch_array(MYSQLI_ASSOC);

	//get food item id
	$food_item_id = $_GET['food_item'];
	
	//get food item name from database
	$query = "
		select 
			f.name as food_item_name,
			r.name as restaurant_name
		from food_item as f
		left join restaurant as r
			on f.restaurant_id = r.restaurant_id
		where food_item_id='$food_item_id';
	";
	
	$result = $conn->query($query);
	
	if(!$result) die($conn->error);	
	$food_item = $result->fetch_array(MYSQLI_ASSOC);	

	//print header and review form
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-6">
					<h2 style='text-align:left'>Tell us what you thought about the $food_item[food_item_name] at $food_item[restaurant_name]</h2>
				</div>	
			</div>
			<div class='row'>
				<div class='col-sm-6'>
					<form method='post' style='text-align:left'>
						<div>
							Rating: 
							<input type ="radio" name='review-rating' value ='1'> 1 star
							<input type ="radio" name='review-rating' value ='2'> 2 stars
							<input type ="radio" name='review-rating' value ='3'> 3 stars
							<input type ="radio" name='review-rating' value ='4'> 4 stars
							<input type ="radio" name='review-rating' value ='5'> 5 stars
							<br><br>
						</div>
						<div>
							Review title: <br><input type='text' name='review-title'></input><br><br>
							Review description: <br><input type='text' name='review-description'></input><br><br>
						</div>
							<input type='hidden' name='member_id' value='$member[member_id]'>
							<input type='submit' value='Add review'></input>
					</form>
				</div>
			</div>
		</div>
	_END;
}

//check if rating submitted and write review to database
if(isset($_POST["review-rating"]))	{
	//rating
	$review_rating = $_POST['review-rating'];
	
	//title
	if(isset($_POST["review-title"]))	{
		$review_title = $_POST['review-title'];
	} else {
		$review_title = "";
	}
	
	//description
	if(isset($_POST['review-description']))	{
		$review_description = mysql_entities_fix_string($conn, $_POST["review-description"]);
	} else {
		$review_description = "";
	}
	
	//date
	$today = date("Y-m-d");
	$review_date = $today;
	
	//member id
	$member_id = $_POST["member_id"];
	
	//write review to database
	$query = "
		insert into review (food_item_id, member_id, title, description, rating, date)
		values ('$food_item_id', '$member_id', '$review_title', '$review_description', '$review_rating', '$review_date');
	";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);

	$conn->close();
	
	header("Location: review-list.php?food_item=$food_item_id");
}




?>

	</body>
</html>