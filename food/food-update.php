<?php

require_once  '../db/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_GET['food_item_id'])){
	
$food_item_id = $_GET['food_item_id'];	

$query = "SELECT * FROM food_item where food_item_id=$food_item_id ";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++)
{
	//$result->data_seek($j); 
	$row = $result->fetch_array(MYSQLI_ASSOC); 
	
	$photo = $row['photo'];
	
echo <<<_END
	
	<form action='food-update.php' method='post'>

	<pre>
	
	<img src='$photo' width='200' height='300'>
	
	Name: <input type='text' name='name' value='$row[name]'>
	Description: <input type='text' name='description' value='$row[description]'>
	Type: <input type='text' name='type' value='$row[type]'>
	Price: <input type='number' name='price' value='$row[price]'>
	Image Path: <input type='text' name='photo' value='$photo'>

	</pre>
	
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='food_item_id' value='$row[food_item_id]'>
		<input type='submit' value='UPDATE RECORD'>
		
	</form>
	<form action='food-details.php?food_item_id=$row[food_item_id]' method='post'>
		<input type='hidden' name='food_item_id' value='$row[food_item_id]'>
		<input type='submit' value='CANCEL'>	
	</form>
	
_END;

}

}


if(isset($_POST['update'])){
	
	$food_item_id = $_POST['food_item_id'];
	$name = $_POST['name'];
	$type = $_POST['type'];
	$description = $_POST['description'];
	$price = $_POST['price'];	
	$imagepath = $_POST['photo'];
	
	$query = "Update food_item set name='$name', type='$type', description='$description', price='$price', photo='$imagepath' where food_item_id = $food_item_id ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: food-view.php");
	
	
}

$conn->close();



?>