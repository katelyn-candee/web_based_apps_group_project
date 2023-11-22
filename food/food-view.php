<?php

require_once  '../db/login.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM food_item";

$result = $conn->query($query);
if(!$result) die($conn->error);

$rows = $result->num_rows;

echo <<<_END
	<form action='food-add.php' method='post'>
		<input type='submit' value='ADD FOOD ITEM'>
	</form>

_END;


for($j=0; $j<$rows; ++$j){
	//$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);

echo <<<_END

	<pre>
	Image: $row[photo]
	Name: <a href= 'food-details.php?food_item_id=$row[food_item_id]'>$row[name]</a>
	Type: $row[type]
	Price: $row[price]	
	</pre>
	
_END;

}


// Close the connection
$conn->close();
?>
