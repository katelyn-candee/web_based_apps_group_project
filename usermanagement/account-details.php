<?php
$page_roles = array('admin','member','restaurant');
// Database connection details
require_once '../db/login.php';
require_once '../usermanagement/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$user = $_SESSION['user'];
$user_id = $user->user_id;
// Query member table
$member_query = "SELECT first_name, last_name, city, state FROM member WHERE user_id = '$user_id'";
$member_result = $conn->query($member_query);

// Query user table
$user_query = "SELECT username,role,user_id FROM user WHERE user_id = '$user_id'";
$user_result = $conn->query($user_query);

$conn->close();
?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="stylesheet" href="../home/food-style.css"> 
</head>
<body>

    <h2>Account Details</h2>

    <?php
    // Display user details if available
    if ($member_result->num_rows > 0 && $user_result->num_rows > 0) {
        $member_row = $member_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
        echo <<<_END
	    	
	    <pre style='font-family: Times New Roman, sans-serif;color: #2F363E;'>
	
	    <strong>First Name:</strong> $member_row[first_name]
	    <strong>Last Name:</strong> $member_row[last_name]
	    <strong>Username:</strong> $user_row[username]
	    <strong>City:</strong> $member_row[city]
	    <strong>State:</strong> $member_row[state]
	    <strong>Account Type:</strong> $user_row[role]
	    <strong>User ID:</strong> $user_row[user_id]	
	
	    </pre>

		<form action='update-member-account.php' method='post'>
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='user_id' value='$row[user_id]'>
		<input type='submit' value='UPDATE CARD'>	
	    </form>	
	
_END;
    } else {
        echo "<p>Error retrieving user details.</p>";
    }
    ?>

    <br>
//FIX BUTTONS!!!!!!
//FIX UPDATE MEMBER ACCOUNT!!!!!
//FIX COLOR SCHEME

    <a href="logout.php">Logout</a>
    <a href="../home/home-page.php">Back to Home Page</a>

</body>
</html>
