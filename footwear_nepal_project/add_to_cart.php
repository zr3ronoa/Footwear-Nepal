<?php
// Start a session to hold cart data
session_start();

// Database connection details

require "db.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve product details from the POST request
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_price = $conn->real_escape_string($_POST['product_price']);
    $product_image = $conn->real_escape_string($_POST['product_image']);
    
    // Ensure the user is logged in and retrieve the user ID
    if (isset($_SESSION['user'])) {
        // If $_SESSION['user'] is a string (e.g., the username)
        $username = $_SESSION['user'];

        // Retrieve the user ID from the database
        $result = $conn->query("SELECT id FROM users WHERE username = '$username'");
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['id'];
        } else {
            echo "User not found.";
            exit();
        }
    } else {
        // Redirect to login if the user is not logged in
        echo '<script type="text/javascript">
                     alert("You are not logged in .Please login");
                     window.location.href = "login.html"; 
              </script>';
        exit();
    }

    // Save the product details into the session (optional)
    $_SESSION['cart'][] = [
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
    ];

    // Insert the product details into the database along with the user_id
    $sql = "INSERT INTO cart (user_id, product_name, product_price, product_image) 
            VALUES ('$user_id', '$product_name', '$product_price', '$product_image')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the cart page
        header("Location: add_to_cart1.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
