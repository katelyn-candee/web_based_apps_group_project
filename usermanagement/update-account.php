<html>
	<head>
	<title>Update Account</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../home/food-style.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	</head>
	<body>
	<nav class="navbar navbar-default">
	  		<div class="container">
				<div class="navbar-header">
		   			<a class="navbar-brand" href="#myPage"><span class="glyphicon glyphicon-globe logo"></span></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
		  			<ul class="nav navbar-nav navbar-right">
		  				<li><a href="../home/home-page.php">Home</a></li>
						<li><a href="../restaurants/restaurant-list.php">Restaurants</a></li>
						<li><a href="../usermanagement/account-details.php">Profile</a></li>
						<li><a href="../usermanagement/account-login.php">LOGOUT</a></li>
		  			</ul>
				</div>
	  		</div>
		</nav>

	</body>
</html>
<?php
$page_roles = array('admin','member','restaurant');
// Database connection details
require_once '../db/login.php';
require_once '../usermanagement/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$_SESSION['user'] = $user;
$user_id = $user->user_id;

// Query member table
$member_query = "SELECT first_name, last_name, city, state FROM member WHERE user_id = '$user_id'";
$member_result = $conn->query($member_query);

// Query restaurant table
$restaurant_query = "SELECT name, type, description, address, phone, website, email, photo, owner_name FROM restaurant WHERE user_id = '$user_id'";
$restaurant_result = $conn->query($restaurant_query);

// Query user table
$user_query = "SELECT username,role,user_id FROM user WHERE user_id = '$user_id'";
$user_result = $conn->query($user_query);

if ($member_result->num_rows > 0 && $user_result->num_rows > 0) {
        $member_row = $member_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
	
	
	echo <<<_END
	<h2>Update Account Details</h2>
	<form action='update-account.php' method='post'>
	
	<pre>
	
	First Name: <input type='text' name='first_name' value='$member_row[first_name]'>
	Last Name: <input type='text' name='last_name' value='$member_row[last_name]'>
	Username: <input type='text' name='username' value='$user_row[username]'>
	Password: <input type='text' name='password' value='$user_row[password]'>
	City: <input type='text' name='city' value='$member_row[city]'>
	State: <input type='text' name='state' value='$member_row[state]'>
	Account Type: $user_row[role]
	
	</pre>

		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='user_id' value='$user_row[user_id]'>
		<input type='submit' value='UPDATE ACCOUNT'>	
	</form>
	<form action="delete-account.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type='hidden' name='user_id' value='$user_row[user_id]'>
	<input type="submit" value="DELETE ACCOUNT">
	</form>
	
	<a href="logout.php">Logout</a>
    <a href="../home/home-page.php">Back to Home Page</a>
_END;
} else if ($restaurant_result->num_rows > 0 && $user_result->num_rows > 0) {
        $restaurant_row = $restaurant_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
	
	
	echo <<<_END
	<h2>Update Account Details</h2>
	<form action='update-account.php' method='post'>
	
	<pre>
	
	Restaurant Name: <input type='text' name='name' value='$restaurant_row[name]'>
	Owner Name: <input type='text' name='owner_name' value='$restaurant_row[owner_name]'>
	Restaurant Type: <input type='text' name='type' value='$restaurant_row[type]'>
	Description: <input type='text' name='description' value='$restaurant_row[description]'>
	Address: <input type='text' name='address' value='$restaurant_row[address]'>
	Phone: <input type='text' name='phone' value='$restaurant_row[phone]'>
	Website: <input type='text' name='website' value='$restaurant_row[website]'>
	Email: <input type='text' name='email' value='$restaurant_row[email]'>
	Photo: <input type='text' name='photo' value='$restaurant_row[photo]'>
	Username: <input type='text' name='username' value='$user_row[username]'>
	Password: <input type='text' name='password' value='$user_row[password]'>
	Account Type: $user_row[role]
	
	</pre>

		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='user_id' value='$user_row[user_id]'>
		<input type='submit' value='UPDATE ACCOUNT'>	
	</form>
	<form action="delete-account.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type='hidden' name='user_id' value='$user_row[user_id]'>
	<input type="submit" value="DELETE ACCOUNT">
	</form>
	
	<a href="../usermanagement/account-login.php">Logout</a><br>

_END;
}


if(isset($_POST['update'])){
	$user_id= mysql_entities_fix_string($conn,$_POST['user_id']);
	$first_name= mysql_entities_fix_string($conn,$_POST['first_name']);
	$last_name= mysql_entities_fix_string($conn,$_POST['last_name']);
	$username= mysql_entities_fix_string($conn,$_POST['username']);
	$password= mysql_entities_fix_string($conn,$_POST['password']);
	$token = password_hash($password, PASSWORD_DEFAULT); // Hash the password
	$city= mysql_entities_fix_string($conn,$_POST['city']);
	$state= mysql_entities_fix_string($conn,$_POST['state']);
	$name= mysql_entities_fix_string($conn,$_POST['name']);
	$owner_name= mysql_entities_fix_string($conn,$_POST['owner_name']);
	$type= mysql_entities_fix_string($conn,$_POST['type']);
	$description= mysql_entities_fix_string($conn,$_POST['description']);
	$address= mysql_entities_fix_string($conn,$_POST['address']);
	$phone =  mysql_entities_fix_string($conn,$_POST['phone']);
	$website= mysql_entities_fix_string($conn,$_POST['website']);
	$user_id= mysql_entities_fix_string($conn,$_POST['user_id']);
	$email= mysql_entities_fix_string($conn,$_POST['email']);
	$photo= mysql_entities_fix_string($conn,$_POST['photo']);
	
	$u_query = "UPDATE user SET username='$username',password='$token' where user_id=$user_id";
	
	$u_result = $conn->query($u_query); 
	if(!$u_result) die($conn->error);
	
	$m_query = "UPDATE member SET first_name='$first_name', last_name='$last_name', city='$city', state='$state' where user_id=$user_id";
	
	$m_result = $conn->query($m_query); 
	if(!$m_result) die($conn->error);
	
	$r_query = "UPDATE restaurant SET name='$name', owner_name='$owner_name', type='$type', description='$description', address='$address', phone='$phone', website='$website', email='$email',photo='$photo' where user_id=$user_id";
	
	$r_result = $conn->query($r_query); 
	if(!$r_result) die($conn->error);
	
	header("Location: account-details.php");
}

$conn->close();
//sanitization functions
function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string){
	$string = stripslashes($string);
	return $conn->real_escape_string($string);
}


?>

//fix Delete!!!