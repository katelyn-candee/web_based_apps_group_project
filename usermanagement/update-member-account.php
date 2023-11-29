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

// Query user table
$user_query = "SELECT username,role,user_id FROM user WHERE user_id = '$user_id'";
$user_result = $conn->query($user_query);

if ($member_result->num_rows > 0 && $user_result->num_rows > 0) {
        $member_row = $member_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
	
	
	echo <<<_END
	<h2>Update Account Details</h2>
	<form action='update-member-account.php' method='post'>
	
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
}


if(isset($_POST['update'])){
	$user_id=$_POST['user_id'];
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$city=$_POST['city'];
	$state=$_POST['state'];

	

	
	$u_query = "UPDATE user SET username='$username',password='$password' where user_id=$user_id";
	
	$u_result = $conn->query($u_query); 
	if(!$u_result) die($conn->error);
	
	$m_query = "UPDATE member SET first_name='$first_name', last_name='$last_name', city='$city', state='$state' where user_id=$user_id";
	
	$m_result = $conn->query($m_query); 
	if(!$m_result) die($conn->error);
	
	header("Location: account-details.php");
}

$conn->close();

?>