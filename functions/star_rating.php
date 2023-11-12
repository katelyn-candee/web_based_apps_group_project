<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	</head>
	<body>
	</body>
</html>

<?php
// displays provided rating as stars using font-awesome css library
function displayStarRating($rating) {
    $stars = "";
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '<i class="fas fa-star"></i>'; // Solid star for a filled rating
        } else {
            $stars .= '<i class="far fa-star"></i>'; // Outline star for an unfilled rating
        }
    }
    return $stars;
}

?>