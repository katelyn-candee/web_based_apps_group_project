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
            <form action="account-login.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <input type="submit">Login</input>
                <a>New Here? </a><a href="create-account.php">Click to Create An Account!</a>
            </form>
        </div>
    </body>
</html>
<?php
require_once '../db/login.php';
require_once 'User.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tmp_username = mysql_entities_fix_string($conn, $_POST['username']);
	$tmp_password = mysql_entities_fix_string($conn, $_POST['password']);
	
	$query = "SELECT password FROM user WHERE username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result){die($conn->error);}
	
	$rows = $result->num_rows;
	$passwordFromDB="";
	
	for($j=0; $j<$rows; $j++){
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$passwordFromDB = $row['password'];
	}
	
	if(password_verify($tmp_password,$passwordFromDB)){
	//if($tmp_password==$passwordFromDB){	
		$user = new User($tmp_username);

		session_start();
		$_SESSION['user'] = $user;
				
		header("Location: ../home/home-page.php");
		exit();
	}else{
        echo "<p style='color: red; text-align: center;'>Invalid username or password.</p>";
    }
}

//sanitization functions
function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string){
	$string = stripslashes($string);
	return $conn->real_escape_string($string);
}

?>
