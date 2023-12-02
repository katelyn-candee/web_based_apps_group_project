<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../style/style.css"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	</head>
	<body>
		<nav class="navbar navbar-default">
		  <div class="container">
			<div class="navbar-header">
			   <a class="navbar-brand" href="../home/home-page.php"><span class="glyphicon glyphicon-cutlery logo"> food review app<br></span></a>
			</div>
			<br><br>
			<div class="collapse navbar-collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="../restaurants/restaurant-list.php">Restaurants</a></li>
<?php
require_once "../usermanagement/User.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['user'])) {
	echo "<li><a href='../usermanagement/account-details.php'>My Account</a></li>";
	echo "<li><a href='../usermanagement/account-logout.php'>Logout</a></li>";
} else {
	echo "<li><a href='../usermanagement/account-login.php'>Login</a></li>";
}
?>
			  </ul>
			</div>
		  </div>
		</nav>
		<br><br>
	</body>
</html>