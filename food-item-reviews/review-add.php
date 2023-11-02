<html>
	<head>
		<title>Add Review</title>
	</head>
	</body>
		<h1>Food Review App</h1>
		<h2>Your review for [food item]</h2>
		<form method='post' action='food-item-reviews.php'>
			<div>
				Rating:
				<input type ="radio" name='rating' value ='1'>1 star
				<input type ="radio" name='rating' value ='2'>2 stars
				<input type ="radio" name='rating' value ='3'>3 stars
				<input type ="radio" name='rating' value ='4'>4 stars
				<input type ="radio" name='rating' value ='5'>5 stars
			</div>
			<div>
				Review title:<input type='text'></input><br>
				Review description:<input type='text'></input><br>
			</div>
			<input type='submit' value='Add review'></input>
		</form>
	</body>
</html>