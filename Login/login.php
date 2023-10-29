<!DOCTYPE html>
<html>
<head>
    <title>Food App Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('food_app_background.png'); /* Replace 'kitchen-background.jpg' with your image file path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 300px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login to Food App</h2>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Your authentication logic goes here.
            // Check the username and password and redirect accordingly.
            if ($username === "your_username" && $password === "your_password") {
                // Successful login, you can redirect the user to another page.
                header("Location: welcome.php");
                exit();
            } else {
                echo "<p style='color: red; text-align: center;'>Invalid username or password.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
