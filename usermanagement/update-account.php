<html>
	<head>
	<title>My Account</title>
<?php
require_once "../style/header.php";
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
	<div class='container-fluid card'>
		<div class='row'>
			<div class='col-sm-12'>
				<h2 style='text-align:left'>Update your account</h2><br>
			</div>
		</div>
		<div class='row'>				
			<form action='update-account.php' method='post' style='text-align:left'>
				<div class='col-sm-6'>
					First Name: <br><input type='text' name='first_name' value='$member_row[first_name]'><br><br>
					Last Name: <br><input type='text' name='last_name' value='$member_row[last_name]'><br><br>
					Username: <br><input type='text' name='username' value='$user_row[username]' required><br><br>
					Password: <br><input type='password' name='password' required><br><br>
					City: <br><input type='text' name='city' value='$member_row[city]'><br><br>
					State: <br><input type='text' name='state' value='$member_row[state]'><br><br>
				</div>
				<div class='col-sm-6'>
					Account Type: <br>$user_row[role]<br><br>
					<input type='hidden' name='update' value='yes'>
					<input type='hidden' name='user_id' value='$user_row[user_id]'>
					<input type='submit' value='Update account'><br>	
				</form>
				<form action='delete-account.php' method='post' style='text-align:left'>
					<input type='hidden' name='delete' value='yes'>
					<input type='hidden' name='user_id' value='$user_row[user_id]'><br>
					<input type='submit' value='Delete account'><br>
				</form>
			</div>
		</div>
	</div>
_END;

} else if ($restaurant_result->num_rows > 0 && $user_result->num_rows > 0) {
        $restaurant_row = $restaurant_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
	
	
	echo <<<_END
		<div class='container-fluid card'>
			<div class='row'>
				<div class='col-sm-12'>
					<h2 style='text-align:left'>Update your account</h2><br>
				</div>
			</div>
			<div class='row'>
				<form action='update-account.php' method='post' style='text-align:left'>
					<div class='col-sm-6'>
						Restaurant Name: <br><input type='text' name='name' value='$restaurant_row[name]'><br><br>
						Owner Name: <br><input type='text' name='owner_name' value='$restaurant_row[owner_name]'><br><br>
						Restaurant Type: <br><input type='text' name='type' value='$restaurant_row[type]'><br><br>
						Description: <br><input type='text' name='description' value='$restaurant_row[description]'><br><br>
						Address: <br><input type='text' name='address' value='$restaurant_row[address]'><br><br>
						Phone: <br><input type='text' name='phone' value='$restaurant_row[phone]'><br><br>
						Website: <br><input type='text' name='website' value='$restaurant_row[website]'><br><br>
					</div>
					<div class='col-sm-6'>
						Email: <br><input type='text' name='email' value='$restaurant_row[email]'><br><br>
						Photo: <br><input type='text' name='photo' value='$restaurant_row[photo]'><br><br>
						Username: <br><input type='text' name='username' value='$user_row[username]' required><br><br>
						Password: <br><input type='password' name='password' required><br><br>
						Account Type: <br>$user_row[role]
						<input type='hidden' name='update' value='yes'><br><br>
						<input type='hidden' name='user_id' value='$user_row[user_id]'>
						<input type='submit' value='Update account'>	<br><br>
				</form>
				<form action='delete-account.php' method='post' style='text-align:left'>
					<input type='hidden' name='delete' value='yes'>
					<input type='hidden' name='user_id' value='$user_row[user_id]'>
					<input type='submit' value='Delete account'><br>
				</form>
		</div>
	</div>
</div>


_END;

} else if ($user_result->num_rows > 0) {
        $restaurant_row = $restaurant_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
	
	
	echo <<<_END
		<div class='container-fluid card'>
			<div class='row'>
				<div class='col-sm-12'>
					<h2 style='text-align:left'>Update your account</h2><br>
				</div>
			</div>
			<div class='row'>
				<form action='update-account.php' method='post' style='text-align:left'>
					<div class='col-sm-6'>
						Username: <br><input type='text' name='username' value='$user_row[username]' required><br><br>
						Password: <br><input type='password' name='password' required><br><br>
						Account Type: <br>$user_row[role]
						<input type='hidden' name='update' value='yes'><br><br>
						<input type='hidden' name='user_id' value='$user_row[user_id]'>
						<input type='submit' value='Update account'>	<br><br>
				</form>
				<form action='delete-account.php' method='post' style='text-align:left'>
					<input type='hidden' name='delete' value='yes'>
					<input type='hidden' name='user_id' value='$user_row[user_id]'>
					<input type='submit' value='Delete account'><br>
				</form>
		</div>
	</div>
</div>


_END;
}


if(isset($_POST['update'])){
	
	if ($member_result->num_rows > 0 && $user_result->num_rows > 0){
		
		$user_id= mysql_entities_fix_string($conn,$_POST['user_id']);
		$first_name= mysql_entities_fix_string($conn,$_POST['first_name']);
		$last_name= mysql_entities_fix_string($conn,$_POST['last_name']);
		$username= mysql_entities_fix_string($conn,$_POST['username']);
		$password= mysql_entities_fix_string($conn,$_POST['password']);
		$token = password_hash($password, PASSWORD_DEFAULT); // Hash the password
		$city= mysql_entities_fix_string($conn,$_POST['city']);
		$state= mysql_entities_fix_string($conn,$_POST['state']);
		
		$u_query = "UPDATE user SET username='$username',password='$token' where user_id=$user_id";
	
		$u_result = $conn->query($u_query); 
		if(!$u_result) die($conn->error);
		
		$m_query = "UPDATE member SET first_name='$first_name', last_name='$last_name', city='$city', state='$state' where user_id=$user_id";
		
		$m_result = $conn->query($m_query); 
		if(!$m_result) die($conn->error);
		
	} else if ($restaurant_result->num_rows > 0 && $user_result->num_rows > 0) {
		
		
		$user_id= mysql_entities_fix_string($conn,$_POST['user_id']);
		$username= mysql_entities_fix_string($conn,$_POST['username']);
		$password= mysql_entities_fix_string($conn,$_POST['password']);
		$token = password_hash($password, PASSWORD_DEFAULT); // Hash the password
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
		
		$r_query = "UPDATE restaurant SET name='$name', owner_name='$owner_name', type='$type', description='$description', address='$address', phone='$phone', website='$website', email='$email',photo='$photo' where user_id=$user_id";
		
		$r_result = $conn->query($r_query); 
		if(!$r_result) die($conn->error);
	
	} else if ($user_result->num_rows > 0) {
		
		
		$user_id= mysql_entities_fix_string($conn,$_POST['user_id']);
		$username= mysql_entities_fix_string($conn,$_POST['username']);
		$password= mysql_entities_fix_string($conn,$_POST['password']);
		$token = password_hash($password, PASSWORD_DEFAULT); // Hash the password
		
		$u_query = "UPDATE user SET username='$username',password='$token' where user_id=$user_id";
	
		$u_result = $conn->query($u_query); 
		if(!$u_result) die($conn->error);
		
	}
		
	Header("Location: ../usermanagement/account-details.php");
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
