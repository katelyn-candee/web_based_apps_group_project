<html>
	<head>
		<title>Update Review</title>

<?php
//import functions
require_once "../style/header.php";
require_once "../db/login.php";
require_once "../db/sanitize.php";
require_once "../usermanagement/User.php";

$page_roles = array("admin", "member");

require_once "../usermanagement/checksession.php";

//create database connection
	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);

//check if review id was passed
if(isset($_GET['review']))	{

	//get review id
	$review_id = $_GET['review'];
	
	//get review data from database
	$query = "
		select 
			rev.*,
			f.name as food_item_name,
			res.name as restaurant_name
		from review as rev
		left join food_item as f
			on rev.food_item_id = f.food_item_id
		left join restaurant as res
			on f.restaurant_id = res.restaurant_id
		where review_id='$review_id';
	";
	
	$result = $conn->query($query);
	
	if(!$result) die($conn->error);	
	$review = $result->fetch_array(MYSQLI_ASSOC);
	
	//rating
	$rating1=$rating2=$rating3=$rating4=$rating5=0;
	if($review['rating']==1) $rating1 = 'checked';
	if($review['rating']==2) $rating2 = 'checked';
	if($review['rating']==3) $rating3 = 'checked';
	if($review['rating']==4) $rating4 = 'checked';
	if($review['rating']==5) $rating5 = 'checked';

	//print header and review form
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-6">
					<h2>Tell us what you thought about the $review[food_item_name] at $review[restaurant_name]</h2>
				</div>	
			</div>
			<div class='row'>
				<div class='col-sm-6'>
					<form method='post' style='text-align:left'>
						<div>
							Rating: 
							<input type ="radio" name='review-rating' value ='1' $rating1> 1 star
							<input type ="radio" name='review-rating' value ='2' $rating2> 2 stars
							<input type ="radio" name='review-rating' value ='3' $rating3> 3 stars
							<input type ="radio" name='review-rating' value ='4' $rating4> 4 stars
							<input type ="radio" name='review-rating' value ='5' $rating5> 5 stars
							<br><br>
						</div>
						<div>
							Review title: <br><input type='text' name='review-title' value='$review[title]'></input><br><br>
							Review description: <br><input type='text' name='review-description' value='$review[description]'></input><br><br>
						</div>
							<input type='submit' value='Update review'></input>
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
	if(isset($_POST["review-title"]))	{
	
	//title
	$review_title = mysql_entities_fix_string($conn, $_POST['review-title']);
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
	
	//write review to database
	$query = "
		update review 
		set
			title = '$review_title', 
			description = '$review_description', 
			rating = '$review_rating', 
			date = '$review_date'
		where review_id = '$review_id';
	";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);

	$conn->close();
	
	header("Location: review-list.php?food_item=$review[food_item_id]");
}

?>

	</body>
</html>