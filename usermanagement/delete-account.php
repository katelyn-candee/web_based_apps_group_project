<?php

$page_roles = array('member', 'restaurant');

require_once  '../db/dbinfo.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$user_id = $_POST['user_id'];

	$query = "DELETE FROM user WHERE user_id='$user_id' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$query1 = "DELETE FROM member WHERE user_id='$user_id' ";
	
	$result = $conn->query($query1); 
	if(!$result) die($conn->error);
	
	$query2 = "DELETE FROM restaurant WHERE user_id='$user_id' ";
	
	$result = $conn->query($query2); 
	if(!$result) die($conn->error);
	
	header("Location: account-login.php");
	
}


?>