<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="food-style.css"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

	</head>
	
	<body>
		<!-- Navbar -->
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

	<!--Carousel-->	
<?php
$page_roles = array('admin','member','restaurant');
require_once '../db/login.php';
require_once '../usermanagement/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM review ORDER BY review_id DESC LIMIT 5;";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<h1>Check out these recent reviews!</h1>';
    echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
    echo '<ol class="carousel-indicators">';

    // carousel indicators
    $indicatorIndex = 0;
    while ($row = $result->fetch_assoc()) {
        $active = ($indicatorIndex == 0) ? 'active' : ''; // Set 'active' only for the first indicator
        echo '<li data-target="#myCarousel" data-slide-to="' . $indicatorIndex . '" class="' . $active . '"></li>';
        $indicatorIndex++;
    }
    echo '</ol>';

    $result->data_seek(0);

    echo '<div class="carousel-inner" role="listbox">';

    // carousel items
    while ($row = $result->fetch_assoc()) {
        $active = ($active == 'active') ? '' : 'active'; // Toggle 'active' for each item
        echo '<div class="item ' . $active . '">';
        echo '<h3>';
        echo '<br><br><br>';
        echo '<strong>' . $row['title'] . '</strong><br><br>';
        echo '<p>' . $row['description'] . '</p><br>';
        echo '<strong>Rating:</strong> ' . $row['rating'] . ' Stars<br>';
        echo '<strong>Date Posted:</strong> ' . $row['date'] . '<br>';
        echo '</h3>';
        echo '</div>';
    }

    echo '</div>';

    // left and right controls
    echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
    echo '<span class="glyphicon glyphicon-chevron-left"></span>';
    echo '<span class="sr-only">Previous</span>';
    echo '</a>';

    echo '<a class="right carousel-control" href="#myCarousel" data-slide="next">';
    echo '<span class="glyphicon glyphicon-chevron-right"></span>';
    echo '<span class="sr-only">Next</span>';
    echo '</a>';

    echo '</div>'; 
}

$conn->close();
?>

		
		<!-- Search form -->
		<h1> Search </h1>
		<div class='form' style='text-align:center'>
			<form method='post' action='../restaurants/restaurant-list.php'>
				<input type='text' name='search' value='e.g. italian'>
				<submit type='button' value='Search'>
			</form>
		</div>
		
		<!-- Category Table-->
		<h1> Categories </h1>
			<table class="card-table">
				<tr>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=indian"><h3>Indian</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=southern"><h3>Southern</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=seafood"><h3>Seafood</h3></a></td>
				</tr>
				<tr>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=italian"><h3>Italian</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=mediterranean"><h3>Mediterranean</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=japanese"><h3>Japanese</h3></a></td>
				</tr>
				<tr>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=vegetarian"><h3>Vegetarian</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=steak"><h3>Steakhouse</h3></a></td>
					<td class="card"><a href="../restaurants/restaurant-list.php?category=american"><h3>American</h3></a></td>
				</tr>
			</table>

    	
    	<br><br><br><br>




	</body>


</html>