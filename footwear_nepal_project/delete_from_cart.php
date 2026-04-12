<?php
session_start(); // Start the session
require "db.php"; // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];

    // Retrieve user ID from the database
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
}

// Check if product_id is provided
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    echo "Product ID is required.";
    exit();
}

$product_id = $_GET['product_id'];

// Retrieve the cart ID for the given product and user
$stmt = $conn->prepare("SELECT id FROM cart WHERE product_id = ? AND user_id = ?");
if ($stmt === false) {
    die("Failed to prepare SQL statement: " . $conn->error);
}

$stmt->bind_param("ii", $product_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $cart_item = $result->fetch_assoc();
    $cart_id = $cart_item['id'];
} else {
    echo "No cart item found for the given product.";
    exit();
}
$stmt->close();

// Delete the cart item from the database
$sql = "DELETE FROM cart WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Failed to prepare SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $cart_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Cart item deleted successfully.";
} else {
    echo "Failed to delete cart item.";
}

$stmt->close();
$conn->close();
?>
