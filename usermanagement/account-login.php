<html>
    <head>
        <title>Food App Login</title>
<?php require_once "../style/header.php"; ?>

    <body>
        <div class="container">
            <h2>Sign into your account</h2>
            <form action="account-login.php" method="post">
                <label for="username">Username</label>
                <input class="login" type="text" id="username" name="username" required>
				<br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
				<br><br>
                <input class="login" type="submit" value="Login"></input><br><br>
                New to food review app?<a href="create-account.php"><br>Create an account!</a>
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
