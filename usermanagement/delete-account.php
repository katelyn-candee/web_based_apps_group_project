<?php

$page_roles = array('admin','member','restaurant');

require_once  '../db/login.php';
require_once '../usermanagement/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$user_id = $_POST['user_id'];
	
	//delete reviews associated with user
	$re_query = "DELETE FROM food_item WHERE restaurant_id IN (SELECT restaurant_id FROM restaurant WHERE user_id=$user_id) ";

	$re_result = $conn->query($re_query); 
	if(!$re_result) die($conn->error);
	
	//delete food items associated with user
	$re_query = "DELETE FROM food_item WHERE member_id IN (SELECT member_id FROM member WHERE user_id='$user_id') ";

	$re_result = $conn->query($re_query); 
	if(!$re_result) die($conn->error);

	//delete member associated with user
	$m_query = "DELETE FROM member WHERE user_id='$user_id' ";

	$m_result = $conn->query($m_query); 
	if(!$m_result) die($conn->error);
	
	//delete restaurant associated with user
	$r_query = "DELETE FROM restaurant WHERE user_id='$user_id' ";

	$r_result = $conn->query($r_query); 
	if(!$r_result) die($conn->error);	
	
	//delete user
	$query = "DELETE FROM user WHERE user_id='$user_id' ";

	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	require_once "../usermanagement/account-logout.php";
	
}
$conn->close();



?>