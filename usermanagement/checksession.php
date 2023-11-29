<?php

require_once 'User.php';

session_start();

if(!isset($_SESSION['user'])){
<<<<<<< Updated upstream
	header("Location: account-login.php");
=======
	header("Location: ../usermanagement/account-login.php");
>>>>>>> Stashed changes
	exit();
}else{
	$user = $_SESSION['user'];
	$username = $user->username;
	$user_roles = $user->getRoles();
	
	$found=0;
	foreach($user_roles as $urole){
		foreach($page_roles as $prole){
			if($urole == $prole){
				$found=1;
			}
		}
	}
	
	if(!$found){
		header("Location: unauthorized.php");
		exit();
	}
}



?>