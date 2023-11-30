<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Item Update</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #EBEDD3;
            margin: 0;
            padding: 0;
        }
		
		h1 {
			text-align: center;
			margin-top: 30px;
			font-size: 28px;
			color: #2F363E;
		}

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-cancel {
            background-color: #ccc;
        }
    </style>
</head>
<body>

	<header>
        <h1>Edit Food Item</h1>
    </header>

<?php
require_once '../db/login.php';

require_once "../usermanagement/User.php";

$page_roles = array("admin", "restaurant");

require_once "../usermanagement/checksession.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['food_item_id'])) {

    $food_item_id = $_GET['food_item_id'];

    $query = "SELECT f.food_item_id, f.restaurant_id, f.name, rest.name AS 'r_name', f.description, f.type, f.price, f.photo, AVG(r.rating) AS 'rating' FROM food_item as f LEFT JOIN review as r ON f.food_item_id = r.food_item_id join restaurant as rest on f.restaurant_id = rest.restaurant_id 
	WHERE f.food_item_id=$food_item_id
	GROUP BY food_item_id, restaurant_id, name, description, type, price, photo, r_name; ";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    $rows = $result->num_rows;

    ?>
    <div class="container">
        <?php
        for ($j = 0; $j < $rows; $j++) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $photo = $row['photo'];
            ?>

            <form action='food-update.php' method='post'>
                <img src='<?php echo $photo; ?>' alt='Food Item Photo'>
				
				<label for="r_name">Restaurant:</label>
                <input type='text' name='r_name' value='<?php echo $row['r_name']; ?>' readonly>
				
                <label for="name">Name:</label>
                <input type='text' name='name' value='<?php echo $row['name']; ?>' required>

                <label for="description">Description:</label>
                <input type='text' name='description' value='<?php echo $row['description']; ?>' required>

                <label for="type">Type:</label>
                <input type='text' name='type' value='<?php echo $row['type']; ?>' required>

                <label for="price">Price: $</label>
                <input type='number' name='price' value='<?php echo $row['price']; ?>' required>
				
				<label for="rating">Average Rating:</label>
                <input type='number' name='rating' value='<?php echo $row['rating']; ?>' required readonly>

                <label for="photo">Image Path:</label>
                <input type='text' name='photo' value='<?php echo $photo; ?>' required>

                <input type='hidden' name='update' value='yes'>
				<input type='hidden' name='restaurant_id' value='<?php echo $row['restaurant_id']; ?>'>
                <input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>

                <button type='submit' class='btn'>UPDATE RECORD</button>
            </form>

            <form action='food-details.php?food_item_id=<?php echo $row['food_item_id']; ?>' method='post'>
                <input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>
                <button type='submit' class='btn btn-cancel'>CANCEL</button>
            </form>

        <?php } ?>
    </div>

    <?php
}

if (isset($_POST['update'])) {

    $food_item_id = $_POST['food_item_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagepath = $_POST['photo'];
	$restaurant_id = $_POST['restaurant_id'];

    $query = "UPDATE food_item SET name='$name', type='$type', description='$description', price='$price', photo='$imagepath' WHERE food_item_id = $food_item_id ";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("Location: food-view.php?restaurant=$restaurant_id");
}

$conn->close();
?>

</body>
</html>
