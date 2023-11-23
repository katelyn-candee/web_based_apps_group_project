<?php
$page_roles = array('member');

require_once  '../db/login.php';
require_once  'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_GET['user_id'])){

$user_id = $_GET['user_id'];

$query = "SELECT * FROM user,member WHERE user_id=$user_id";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++){
	$row = $result->fetch_array(MYSQLI_ASSOC); 
	
	
	echo <<<_END
	<form action='update-member-account.php' method='post'>
	
	<pre>
	
	First Name: <input type='text' name='first_name' value='$row[first_name]'>
	Last Name: <input type='text' name='last_name' value='$row[last_name]'>
	Username: <input type='text' name='username' value='$row[username]'>
	Password: <input type='text' name='password' value='$row[password]'>
	Email: <input type='text' name='email' value='$row[email]'>
	City: <input type='text' name='city' value='$row[city]'>
	State: <input type='text' name='state' value='$row[state]'>
	Account Type: $row[role]
	User ID: $row[user_id]	
	
	</pre>

		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='user_id' value='$row[user_id]'>
		<input type='submit' value='UPDATE ACCOUNT'>	
	</form>
	<form action="delete-account.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type="hidden" name="user_id" value="$row[user_id]">
	<input type="submit" value="DELETE ACCOUNT">
	</form>
	
_END;
}
}

if(isset($_POST['update'])){
	$user_id=$_POST['user_id'];
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	
	$query = "UPDATE user SET username='$username', password='$password', role='$role' where user_id=$user_id ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$query = "UPDATE member SET first_name='$first_name', last_name='$last_name', email='$email', city='$city', state='$state' where user_id=$user_id ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: account-details.php");
}

$conn->close();

?>