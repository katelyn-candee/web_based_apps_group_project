<html>
	<head>
		<title>Reviews</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="food-style.css"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	</head>
	</body>
		<div class='container-fluid' >
			<div class='row'>
				<div class='col-sm-12'>
					<h1>Food Review App</h1>
				</div>	
			</div>
		</div>

<?php
//import functions
require_once "../db/login.php";
require_once "../functions/star_rating.php";
require_once "../usermanagement/User.php";

session_start();

//check if food item id was passed
if(isset($_GET['food_item']))	{

	//get food item id
	$food_item_id = $_GET['food_item'];

	//create database connection
	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
	
	//get food item name from database
	$query = "
		select 
			f.name as food_item_name,
			r.name as restaurant_name
		from food_item as f
		left join restaurant as r
			on f.restaurant_id = r.restaurant_id
		where food_item_id='$food_item_id';
	";
	
	$result = $conn->query($query);
	
	if(!$result) die($conn->error);	
	$food_item = $result->fetch_array(MYSQLI_ASSOC);
	
	//display food item reviews header and 'add review' button
	echo <<<_END
		<div class='container-fluid'>
			<div class='row'>
				<div class="col-sm-12">
					<h2>Reviews for the $food_item[food_item_name] at $food_item[restaurant_name]</h2>
				</div>	
			</div>
			<div class='row'>
				<div class='col-sm-12'>
					<a href='review-add.php?food_item=$food_item_id'><button>Add a review</button></a>
				</div>
			</div>
		</div>
	_END;
	
	//get reviews data from database
	$query = "
		select
		r.*,
		m.user_id,
		m.first_name,
		m.last_name,
		m.city,
		m.state
		from review as r
		left join member as m
			on r.member_id = m.member_id
		where food_item_id='$food_item_id';
	";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);

	$rows = $result->num_rows;
	
	if($rows>0)	{
	
		//display reviews
		for ($i=0; $i<$rows; $i++)	{
			$review = $result->fetch_array(MYSQLI_ASSOC);

			echo <<<_END
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-sm-12'>
						
			_END;
			
			echo '<h2>'.displayStarRating($review['rating']).'</h2>';
						
			if(isset($_SESSION['user'])){
				
				//get session user info
				$user = $_SESSION['user'];
				$user_id = $user->user_id;
				$user_roles[] = $user->getRoles();
				
				//check if review blongs to logged in user
				//or if logged in user is an administrator
				if($user_id == $review['user_id']
						or in_array('admin', $user_roles)){
					
					//display review with update and delete links
					echo <<<_END
									<h3>$review[title]</h3>
									<p>$review[description]</p>
								</div>	
							</div>
							<div class='row'>
								<div class='col-sm-6'>
									$review[first_name]<br>
									$review[city], $review[state]
								</div>
								<div class='col-sm-6'>
									<br><a href='review-update.php?review=$review[review_id]'>Update</a>
									<a href='review-delete.php?food_item=$food_item_id&review=$review[review_id]'>Delete</a>
								</div>
							</div> 
						</div>
					_END;
				} else {
					//do not show update and delete buttons
					echo <<<_END
									<h3>$review[title]</h3>
									<p>$review[description]</p>
								</div>	
							</div>
							<div class='row'>
								<div class='col-sm-6'>
									$review[first_name]<br>
									$review[city], $review[state]
								</div>
							</div> 
						</div>
					_END;
					
				}
			} else {
				//do not show update and delete buttons
				echo <<<_END
								<h3>$review[title]</h3>
								<p>$review[description]</p>
							</div>	
						</div>
						<div class='row'>
							<div class='col-sm-6'>
								$review[first_name]<br>
								$review[city], $review[state]
							</div>
						</div> 
					</div>
				_END;
			}
		}
	} else	{
		echo <<<_END
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-sm-12'>
							<p>Be the first to review the $food_item[food_item_name] at $food_item[restaurant_name]!</p>
						</div>	
					</div>
				</div>
		_END;
	}
	
	//close database connection
	$conn->close();
}

?>
	<br><br>
	</body>
</html>

