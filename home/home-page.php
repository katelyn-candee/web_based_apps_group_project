<html>
	<head>
		<title>Home</title>
	</head>
	
<?php
require_once "../style/header.php";
$page_roles = array('admin','member','restaurant');
require_once '../db/login.php';
require_once '../functions/star_rating.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM review ORDER BY date DESC LIMIT 5;";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<div class="card"><h1 style="text-align:center">Check out these recent reviews!</h1>';
    echo '<div id="myCarousel" class="carousel slide card" data-ride="carousel">';
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
		echo "<a href='../reviews/review-list.php?food_item=$row[food_item_id]'>";
        echo '<br><br><br>';
		echo '<h2 style="text-align:center">'. displayStarRating($row['rating']) .'</h2>';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['description'] . '</p><br>';
        echo '<strong>Last updated </strong>' . $row['date'] . '<br>';
		echo "</a>";
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
	echo '</div>';
}

$conn->close();
?>
		
		<!-- Search form -->
		<div class='card'>
		<h1 style='text-align:center'> Search </h1>
		<div class='form style='text-align:center'>
			<form method='post' action='../restaurants/restaurant-list.php'>
				<input type='text' name='search' placeholder='e.g. italian or Steakville'>
				<submit type='button' value='Search'>
			</form>
		</div>
		</div>
		
		<!-- Category Table-->
		<div class='card'>
		<h1 style='text-align:center'> Categories </h1>
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
		</div>

    	
    	<br><br><br><br>




	</body>


</html>