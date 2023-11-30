<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome! Please Create Your Account</h1>
        <form action="create-account.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="role">Role:</label>
            <select name="role" id="role" onchange="showFields()">
                <option value="user">Select One</option>
                <option value="member">Member</option>
                <option value="restaurant">Restaurant</option>
            </select>

            <div id="memberFields" class="hidden">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name">

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name">
                
                <label for="city">City:</label>
                <input type="text" name="city">
                
                <label for="state">State:</label>
                <input type="text" name="state">
            </div>

            <div id="restaurantFields" class="hidden">
                <label for="name">Restaurant Name:</label>
                <input type="text" name="name">
                
                <label for="type">Restaurant Type:</label>
                <input type="text" name="type">

                <label for="description">Description:</label>
                <textarea name="description" rows="4"></textarea>

                <label for="address">Address:</label>
                <input type="text" name="address">
                
                <label for="phone">Phone:</label>
                <input type="tel" name="phone">
                
                <label for="website">Website:</label>
                <input type="url" name="website">

                <label for="email">Email:</label>
                <input type="email" name="email">

                <label for="image">Firm Image:</label>
                <input type="file" id="image" name="image" accept="image/*">

                <label for="owner_name">Owner Name:</label>
                <input type="text" name="owner_name">

            </div>

            <input type="submit" value="CREATE ACCOUNT">
        </form>
    </div>

    <script>
        function showFields() {
            var role = document.getElementById('role').value;
            var memberFields = document.getElementById('memberFields');
            var restaurantFields = document.getElementById('restaurantFields');

            memberFields.classList.add('hidden');
            restaurantFields.classList.add('hidden');

            if (role === 'member') {
                memberFields.classList.remove('hidden');
            } else if (role === 'restaurant') {
                restaurantFields.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
<?php
require_once '../db/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $token = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $role = $_POST["role"];

    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$token', '$role')";

    if ($conn->query($query)) {
        $user_id = $conn->insert_id; 

        if ($role == "member") {
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $city = $_POST["city"];
            $state = $_POST["state"];
            
            $query_member = "INSERT INTO member (user_id, first_name, last_name, city, state) VALUES ('$user_id', '$first_name', '$last_name', '$city', '$state')";
            $conn->query($query_member);
        } elseif ($role == "restaurant") {
            $name = $_POST["name"];
            $type = $_POST["type"];
            $description = $_POST["description"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $website = $_POST["website"];
            $email = $_POST["email"];
            $photo = $_POST["photo"];
            $owner_name = $_POST["owner_name"];

            $query_restaurant = "INSERT INTO restaurant (user_id, name, type, description, address, phone, website, email, photo, owner_name) VALUES ('$user_id', '$name', '$type', '$description', '$address', '$phone', '$website', '$email', '$photo', '$owner_name')";
            $conn->query($query_restaurant);
        }

        header("Location: ../usermanagement/account-login.php");
    } else {
        echo "Error creating account: ".$conn->error;
    }
}

$conn->close();


?>