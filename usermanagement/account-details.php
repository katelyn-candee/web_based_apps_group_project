<html>
	<head>
		<title>Account Details</title>
		<link rel="stylesheet" href="food-style.css">
	
	</head>

	<body>

				
	</body>
</html>


<?php

require_once '../db/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_GET['user_id'])){

$card_id = $_GET['user_id'];
//pull data from either user table, member table, or restaurant
//how to push out only that info onto the page (no blank fields)
$query = "SELECT * FROM user WHERE user_id=$user_id";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++){
	$row = $result->fetch_array(MYSQLI_ASSOC);

	echo <<<_END
			<pre>
				User ID: $row[user_id]
				Userame: $row[username]
				Password: $row[password]//how to hide?
				Card Value: $row[cardValue]
				Points: $row[points]
			</pre>
			<form action='delete-account.php' method='post'>
				<input type='hidden' name='delete' value='yes'>
				<input type='hidden' name='user_id' value='$row[user_id]'>
				<input type='submit' value='DELETE CARD'>			
			</form>
			<form action='update-account.php?user_id=$row[user_id]' method='post'>
				<input type='hidden' name='update' value='yes'>
				<input type='hidden' name='user_id' value='$row[user_id]'>
				<input type='submit' value='UPDATE CARD'>	
			</form>
_END;
}}

$conn->close();

?>