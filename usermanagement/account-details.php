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

// Query restaurant table
$restaurant_query = "SELECT name, type, description, address, phone, website, email, photo, owner_name FROM restaurant WHERE user_id = '$user_id'";
$restaurant_result = $conn->query($restaurant_query);

// Query user table
$user_query = "SELECT username,role,user_id FROM user WHERE user_id = '$user_id'";
$user_result = $conn->query($user_query);

$conn->close();
?>

<html>
<head>
    <title>My Account</title> 

    <?php
	require_once "../style/header.php";
	
	echo <<<_END
		<div class='container-fluid card'>
			<div class='row'>
				<div class='col-sm-12'>
					<h2 style='text-align:left'> Account Details</h2>
				</div>
			</div>
		
	_END;
	
    // Display user details if available
    if ($member_result->num_rows > 0 && $user_result->num_rows > 0) {
        $member_row = $member_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
        echo <<<_END
		
		<div class='row'>
				<div class='col-sm-12'>
					<div style='text-align:left'>
						<strong>First Name:</strong> $member_row[first_name]<br>
						<strong>Last Name:</strong> $member_row[last_name]<br>
						<strong>Username:</strong> $user_row[username]<br>
						<strong>City:</strong> $member_row[city]<br>
						<strong>State:</strong> $member_row[state]<br>
						<strong>Account Type:</strong> $user_row[role]<br>
						<strong>User ID:</strong> $user_row[user_id]<br><br>		
						<a href='../usermanagement/update-account.php'><button>Update account</button></a>
					</div>
				</div>
			</div>
	
_END;
    } else if ($restaurant_result->num_rows > 0 && $user_result->num_rows > 0) {
        $restaurant_row = $restaurant_result->fetch_assoc();
        $user_row = $user_result->fetch_assoc();
        echo <<<_END
	    	
	    <pre style='font-family: Times New Roman, sans-serif;color: #2F363E;'>
	
	    <strong>Resaturant Name:</strong> $restaurant_row[name]
	    <strong>Owner Name:</strong> $restaurant_row[owner_name]
	    <strong>Restaurant Type:</strong> $restaurant_row[type]
	    <strong>Description:</strong> $restaurant_row[description]
	    <strong>Address:</strong> $restaurant_row[address]
	    <strong>Phone:</strong> $restaurant_row[phone]
	    <strong>Website:</strong> $restaurant_row[website]
	    <strong>Email:</strong> $restaurant_row[email]
	    <strong>Photo:</strong> $restaurant_row[photo]
	    <strong>Username:</strong> $user_row[username]
	    <strong>Account Type:</strong> $user_row[role]
	    <strong>User ID:</strong> $user_row[user_id]	
	
	    </pre>

		<a href='../usermanagement/update-account.php'><button>Update account</button></a>
	
_END;
    } else {
        echo "<p>Error retrieving user details.</p>";
    }
    ?>

    <br>


</body>
</html>
