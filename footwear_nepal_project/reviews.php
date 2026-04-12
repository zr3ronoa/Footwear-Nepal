<?php

require "db.php";

session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    echo '<script type="text/javascript">alert("You are not logged in .Please login");</script>';
    header('Location: login.html'); // Redirect to login page if user is not logged in
}



// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Failed to prepare SQL statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
    } else {
        echo "User not found.";
        exit();
    }
    $stmt->close();
} else {
    header("Location: login.html");
    exit();
}

// Handle form submission for reviews
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $review_text = $conn->real_escape_string($_POST['review_text']);
    $rating = intval($_POST['rating']);

    if ($rating < 1 || $rating > 5) {
        echo "Invalid rating. Please provide a rating between 1 and 5.";
    } else {
        $stmt = $conn->prepare("INSERT INTO customer_reviews (user_id, customer_name, review_text, rating) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Failed to prepare SQL statement: " . $conn->error);
        }

        $stmt->bind_param("issi", $user_id, $username, $review_text, $rating);
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Your review has been successfully submitted");
                    window.location.href = "reviews.php";
                  </script>';
            exit();
        } else {
            echo "Error submitting your review: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Retrieve the latest reviews
$reviews = [];
$sql_reviews = "
    SELECT r.customer_name, r.rating, r.review_text, DATE_FORMAT(r.created_at, '%M %d, %Y') AS created_at 
    FROM customer_reviews r 
    INNER JOIN users u ON r.user_id = u.id
    ORDER BY r.created_at DESC 
    LIMIT 10
";
$reviews_result = $conn->query($sql_reviews);

if ($reviews_result && $reviews_result->num_rows > 0) {
    $reviews = $reviews_result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootWear Nepal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="reviews.css">
 
</head>
<body>
    <header>
        <a href="#"><img src="images/logo.png" height="65" width="65" class="logo" alt="Logo"></a>
        <div class="icons">
            <a href="index.php" class="fas fa-home"></a>
        </div>
    </header>
<section class="reviews">
    <h2 class="heading">Submit <span>Your Review</span></h2>
    <div class="review">
    <form action="#" method="post">
    <textarea name="review_text" placeholder="Write your review here..."></textarea>
    <select name="rating">
        <option value="" disabled selected>Select Rating</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <button type="submit" >Submit Review</button>
</form>

    </div>
</section>

    <section class="reviews">
    <h1>Customer <span>Reviews</span></h1>
        <?php
        if (!empty($reviews)) {
            foreach ($reviews as $review) {
                echo "
                <div class='review'>
                    <strong>{$review['customer_name']}</strong>
                    <p>Rating: {$review['rating']} / 5</p>
                    <p>{$review['review_text']}</p>
                    <small>Reviewed on: {$review['created_at']}</small>
                </div>";
            }
        } else {
            echo "<p>No reviews available yet!</p>";
        }
        ?>
    </section>

    <footer>
        <div class="credit">Created by <span>FootWear Nepal</span> | All Rights Reserved</div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
