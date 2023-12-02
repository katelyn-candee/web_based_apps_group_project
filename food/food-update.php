<html>
<head>
    <title>Update</title>

<?php
require_once "../style/header.php";
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
    <div class="container-fluid card">
	<h1>Update</h1>
        <?php
        for ($j = 0; $j < $rows; $j++) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $photo = $row['photo'];
            ?>

            <form action='food-update.php?food_item_id=<?php echo $row['food_item_id']; ?>' method='post' style='text-align:left'>
			<div class="row">
				<div class="col-sm-6">
				<img src='<?php echo "../".$photo; ?>' alt='Food Item Photo'><br><br>
				
				Restaurant: <br>
                <input type='text' name='name' value='<?php echo $row['r_name']; ?>' required readonly style='color:gray'><br><br>
				
                Name: <br>
                <input type='text' name='name' value='<?php echo $row['name']; ?>' required><br><br>

                Description: <br>
                <input type='text' name='description' value='<?php echo $row['description']; ?>' required><br><br>

                Type: <br>
                <input type='text' name='type' value='<?php echo $row['type']; ?>' required><br><br>

                Price: <br>
                <input type='number' name='price' value='<?php echo $row['price']; ?>' required><br><br>
				
				Average Rating: <br>
                <input type='number' name='rating' value='<?php echo $row['rating']; ?>' required readonly style='color:gray'><br><br>

                Image Path: <br>
                <input type='text' name='photo' value='<?php echo $photo; ?>' required><br><br>

                <input type='hidden' name='update' value='yes'>
				<input type='hidden' name='restaurant_id' value='<?php echo $row['restaurant_id']; ?>'>
                <input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>

                <button type='submit' class='btn'>Update</button>
            </form>

            <form action='food-details.php?food_item_id=<?php echo $row['food_item_id']; ?>' method='post' style='text-align:left'>
                <br><input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>
                <button type='submit' class='btn btn-cancel'>Cancel</button>
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
