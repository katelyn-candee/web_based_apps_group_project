<?php
require_once  '../db/login.php';

//connect to database
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

//delete review from database
if(isset($_GET['review']))	{
	
	$review_id = $_GET['review'];
	$query = "delete from review 
	where review_id='$review_id'";

	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$food_item_id = $_GET['food_item'];
	
	//return to food item reviews page
	header("Location: food-item-reviews?id=$food_item_id.php");

}

$conn->close();

?>