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
	
	<form action='food-update.php?food_item_id=$row[food_item_id]' method='post'>

	<pre>
	
	<img src='$photo' width='200' height='300'>
	
	Name: '$row[name]'
	Description: '$row[description]'
	Type: '$row[type]'
	Price: $'$row[price]'

	</pre>
	
		
		<input type='submit' value='EDIT RECORD'>	
	</form>
	
	<form action='food-delete.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='food_item_id' value='$row[food_item_id]'>
		<input type='submit' value='DELETE RECORD'>	
	</form>
	
	<form action='food-view.php' method='post'>
		<input type='submit' value='CANCEL'>	
	</form>
	
_END;

}

}


$conn->close();



?>