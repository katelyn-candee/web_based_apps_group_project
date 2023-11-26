<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food App Reviews</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #EBEDD3;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #EBEDD3;
            color: #2F363E;
            padding: 20px;
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

		pre {
			display: flex;
			flex-direction: column;
			background-color: #fff;
			padding: 20px;
			align-items: left;
			border-radius: 8px;
			margin: 20px 0;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}


        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header>
        <h1>Food Items</h1>
    </header>

    <?php
    require_once  '../db/login.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die($conn->connect_error);

    $query = "SELECT f.food_item_id, f.restaurant_id, f.name, f.description, f.type, f.price, f.photo, AVG(r.rating) AS 'rating' FROM food_item as f
	JOIN review as r ON f.food_item_id = r.food_item_id
	GROUP BY food_item_id, restaurant_id, name, description, type, price, photo;";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $rows = $result->num_rows;
    ?>

    <form action='food-add.php' method='post'>
        <button style="padding: 10px 20px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">ADD FOOD ITEM</button>
    </form>

    <?php
    for($j=0; $j<$rows; ++$j){
        $row = $result->fetch_array(MYSQLI_ASSOC);
    ?>

    <pre>
        <img src="<?php echo $row['photo']; ?>" alt="Food Image"><br>
        <strong>Name:<a href="food-details.php?food_item_id=<?php echo $row['food_item_id']; ?>"><?php echo $row['name']; ?></a></strong><br>
        <strong>Type: <?php echo $row['type']; ?></strong><br>
        <strong>Price: $ <?php echo $row['price']; ?></strong><br>
		<strong>Average Rating: <a href="../reviews/review-list.php?food_item=<?php echo $row['food_item_id']; ?>"><?php echo $row['rating']; ?></a></strong>
    </pre>

    <?php
    }

    $conn->close();
    ?>

</body>
</html>
