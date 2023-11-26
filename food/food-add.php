<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Item</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #EBEDD3;
            margin: 0;
            padding: 0;
        }
		h2 {
			text-align: center;
			margin-left: 30px;
			margin-top: 30px;
			font-size: 28px;
			color: #2F363E;
		}

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
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

<div class="container">
    <h2>Add Food Item</h2>
    <form method='post' action='food-add.php'>
        <label for="name">Name:</label>
        <input type='text' name='name' required>

        <label for="restaurant_ID">Restaurant ID:</label>
        <input type='number' name='restaurant_ID' required>

        <label for="type">Type:</label>
        <input type='text' name='type' required>

        <label for="description">Description:</label>
        <input type='text' name='description' required>

        <label for="price">Price:</label>
        <input type='number' name='price' required>

        <label for="photo">Photo Path:</label>
        <input type='text' name='photo' required>

        <button type='submit'class='btn'>Add Record</button>
    </form>
	<form action='food-view.php' method='post'>
        <button type='submit' class='btn btn-cancel'>CANCEL</button>
    </form>
</div>

</body>
</html>

<?php
// Import credentials for db
require_once '../db/login.php';

// Connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['name'])) {
    // Get data from POST object
    $name = $conn->real_escape_string($_POST['name']);
    $restaurant_ID = $_POST['restaurant_ID'];
    $description = $conn->real_escape_string($_POST['description']);
    $type = $conn->real_escape_string($_POST['type']);
    $price = $_POST['price'];
    $photo = $conn->real_escape_string($_POST['photo']);

    $query = "INSERT INTO food_item (name, restaurant_ID, description, type, price, photo) VALUES ('$name', '$restaurant_ID', '$description', '$type', '$price', '$photo')";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("Location: food-view.php"); // This will return you to the view all page
}
?>
