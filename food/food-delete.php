<?php

//import credentials for db
require_once  '../db/login.php';
require_once "../usermanagement/User.php";

$page_roles = array("admin", "restaurant");

require_once "../usermanagement/checksession.php";

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);



if(isset($_POST['delete']))
{
	$food_item_id = $_POST['food_item_id'];

	$query = "DELETE FROM food_item WHERE food_item_id='$food_item_id'";
	
	//Run the query
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$query = "DELETE FROM review WHERE food_item_id='$food_item_id'";
	
	//Run the query
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	//Return to the viewAllClassics page
	header("Location: food-view.php");
	
}


?>