<html>
	<head>
	
	</head>
	
	<body>
		<form method='post' action='food-add.php'>
			<pre>
				Name: <input type='text' name='name'>
				Restaurant_ID: <input type='number' name='restaurant_ID'>
				Type: <input type='text' name='type'>
				Description: <input type='text' name='description'>
				Price: <input type='float' name='price'>
				Photo Path: <input type='text' name='photo'>
				<input type='submit' value='Add Record'>
			</pre>
		</form>
	</body>
</html>


<?php
//import credentials for db
require_once  '../db/login.php';

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['name'])) 
{
	//Get data from POST object
	$name = $_POST['name'];
	$restaurant_ID = $_POST['restaurant_ID'];
	$description = $_POST['description'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$photo = $_POST['photo'];
	
	
	$query = "INSERT INTO food_item (name, restaurant_ID, description, type, price, photo) VALUES ('$name', '$restaurant_ID','$description', '$type', '$price', $photo)";
	
	//echo $query.'<br>';
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: food-view.php");//this will return you to the view all page
	

}



?>