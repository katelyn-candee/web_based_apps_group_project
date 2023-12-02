<html>
<head>
    <title>Details</title>

<?php
require_once "../style/header.php";
require_once '../db/login.php';
require_once "../usermanagement/User.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['food_item_id'])) {

    $food_item_id = $_GET['food_item_id'];

    $query = "SELECT f.food_item_id, f.restaurant_id, f.name, rest.name AS 'r_name', f.description, f.type, f.price, f.photo, AVG(r.rating) AS 'rating' FROM food_item as f LEFT JOIN review as r ON f.food_item_id = r.food_item_id join restaurant as rest on f.restaurant_id = rest.restaurant_id 
	WHERE f.food_item_id=$food_item_id
	GROUP BY food_item_id, restaurant_id, name, description, type, price, photo, r_name;";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    $rows = $result->num_rows;

    ?>
    <div class="container-fluid card">
	<h1>Details</h1>
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
                <input type='text' name='name' value='<?php echo $row['r_name']; ?>' required readonly><br><br>
				
                Name: <br>
                <input type='text' name='name' value='<?php echo $row['name']; ?>' required readonly><br><br>

                Description: <br>
                <input type='text' name='description' value='<?php echo $row['description']; ?>' required readonly><br><br>

                Type: <br>
                <input type='text' name='type' value='<?php echo $row['type']; ?>' required readonly><br><br>

                Price: <br>
                <input type='number' name='price' value='<?php echo $row['price']; ?>' required readonly><br><br>
				
				Average Rating: <br>
                <input type='number' name='rating' value='<?php echo $row['rating']; ?>' required readonly><br><br>

                Image Path: <br>
                <input type='text' name='photo' value='<?php echo $photo; ?>' required readonly><br><br>
				
                
                <button type='submit' class='btn'>Edit food item</button><br><br>
            </form>

            <form action='food-delete.php' method='post' style='text-align:left'>
                <input type='hidden' name='delete' value='yes'>
                <input type='hidden' name='food_item_id' value='<?php echo $row['food_item_id']; ?>'>
                <button type='submit' class='btn btn-delete'>Delete food item</button>
            </form>

            <form action='../food/food-view.php?restaurant=<?php echo $row['restaurant_id']; ?>' method='post' style='text-align:left'>
                <button type='submit' class='btn btn-cancel'>Cancel</button>
            </form>
			
			</div>
			</div>

        <?php } ?>
    </div>

    <?php
}

$conn->close();
?>

</body>
</html>
