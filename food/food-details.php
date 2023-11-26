<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Item Details</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #EBEDD3;
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

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        pre {
            white-space: pre-wrap;
        }

        .btn {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-cancel {
            background-color: #ccc;
        }
    </style>
</head>
<body>

	<header>
        <h1>Food Item Details</h1>
    </header>

<?php
require_once '../db/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['food_item_id'])) {

    $food_item_id = $_GET['food_item_id'];

    $query = "SELECT * FROM food_item WHERE food_item_id=$food_item_id ";

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

            <form action='food-update.php?food_item_id=<?php echo $row['food_item_id']; ?>' method='post'>
                <img src='<?php echo $photo; ?>' alt='Food Item Photo'>
                <pre>
                    Name: '<?php echo $row['name']; ?>'
                    Description: '<?php echo $row['description']; ?>'
                    Type: '<?php echo $row['type']; ?>'
                    Price: $'<?php echo $row['price']; ?>'
                </pre>

                <button type='submit' class='btn'>EDIT RECORD</button>
            </form>

            <form action='food-delete.php' method='post'>
                <input type='hidden' name='delete' value='yes'>
                <input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>
                <button type='submit' class='btn btn-delete'>DELETE RECORD</button>
            </form>

            <form action='food-view.php' method='post'>
                <button type='submit' class='btn btn-cancel'>CANCEL</button>
            </form>

        <?php } ?>
    </div>

    <?php
}

$conn->close();
?>

</body>
</html>
