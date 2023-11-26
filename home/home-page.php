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
						<li><a href="#about">About</a></li>
						<li><a href="#review">Write a Review</a></li>
						<li><a href="#restaurants">Restaurants</a></li>
						<li><a href="../usermanagement/account-details.php?user_id=$row[user_id]">Profile</a></li>
						<li><input type="text" placeholder="Search.."></li>
		  			</ul>
				</div>
	  		</div>
		</nav>
		<!--Jumbotron-->
		<!--<div class="jumbotron text-center">
			<h1>Site Name Here</h1>
			<p>Write out
		</div> -->
		
		<h1>Featured Restaurants</h1>
		<!-- Carousel of Restaurants -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
 		<!-- Indicators -->
  			<ol class="carousel-indicators">
    			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    			<li data-target="#myCarousel" data-slide-to="1"></li>
    			<li data-target="#myCarousel" data-slide-to="2"></li>
  			</ol>

  		<!-- Wrapper for slides -->
  		<div class="carousel-inner" role="listbox">
      		<div class="item active">
        		<h4><img src="salad.jpeg" width="225" height ="175"><br><br>"This company is the best. I am so happy with the result!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
      		</div>
     		<div class="item">
        		<h4><img src="rice.jpg" width="225" height ="175"><br><br>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
      		</div>
      		<div class="item">
        		<h4><img src="burrito.jpg.webp" width="225" height ="175"><br><br>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
      		</div>
    	</div>

  		<!-- Left and right controls -->
  			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    			<span class="glyphicon glyphicon-chevron-left"></span>
    			<span class="sr-only">Previous</span>
  			</a>
  			<a class="right carousel-control" href="#myCarousel" data-slide="next">
    			<span class="glyphicon glyphicon-chevron-right"></span>
    			<span class="sr-only">Next</span>
  			</a>
		</div>
		
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

		<!--Recent Reviews Table-->
		<h2> Recent Activity </h2>
		<table class="card-table">
        	<tr>
            	<td class="card">
                	<h3>Review 1</h3>
                	<p>This is a recent review!</p>
            	</td>
            	<td class="card">
                	<h3>Review 2</h3>
                	<p>This is a recent review!</p>
            	</td>
            	<td class="card">
                	<h3>Review 3</h3>
                	<p>This is a recent review!</p>
            	</td>
        	</tr>
        	<tr>
            	<td class="card">
                	<h3>Review 4</h3>
                	<p>This is a recent review!</p>
            	</td>
            	<td class="card">
                	<h3>Review 5</h3>
                	<p>This is a recent review!</p>
            	</td>
            	<td class="card">
                	<h3>Review 6</h3>
               	 <p>This is a recent review!</p>
            	</td>
        	</tr>
    	</table>
    	
    	<br><br><br><br>




	</body>


</html>