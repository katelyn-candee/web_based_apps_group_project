<?php

$page_roles = array('admin','member','restaurant');

require_once  '../db/login.php';
require_once '../usermanagement/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$user_id = $_POST['user_id'];

	$query = "DELETE FROM user WHERE user_id='$user_id' ";

	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$m_query = "DELETE FROM member WHERE user_id='$user_id' ";

	$m_result = $conn->query($m_query); 
	if(!$m_result) die($conn->error);
	
	$r_query = "DELETE FROM restaurant WHERE user_id='$user_id' ";

	$r_result = $conn->query($r_query); 
	if(!$r_result) die($conn->error);
	
	header("Location: ../usermanagement/account-login.php");
	
}
$conn->close();



?>