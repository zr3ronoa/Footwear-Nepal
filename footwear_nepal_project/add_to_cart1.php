<?php
session_start(); // Start the session

require "db.php";


// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Assuming `$_SESSION['user']` is the username
    $username = $_SESSION['user'];

    // Retrieve the user ID from the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Failed to prepare SQL statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username); // Bind the username
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
    echo '<script type="text/javascript">
                alert("You are not logged in .Please login");
                window.location.href = "login.html"; 
          </script>';
    exit();
}

// Retrieve cart data for the logged-in user
$sql = "
    SELECT c.product_name, c.product_price, c.product_image
    FROM cart c
    WHERE c.user_id = ?
";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Failed to prepare SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id); // Bind the user ID
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootWear Nepal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="add_to_cart.css">
</head>
<body>
    <header>
        <a href="#"><img src="images/logo.png" height="65" width="65" class="logo" alt=""></a>
        <div class="icons">
            <a href="index.php" class="fas fa-home"></a>
        </div>
    </header>

    <h1>Your <span>Cart</span></h1>
    <section class="cart">
        <?php
        // Check if there are items in the cart for the user
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='box'>
                    <img src='{$row['product_image']}' alt='{$row['product_name']}'>
                    <div class='content'>
                        <h3>{$row['product_name']}</h3>
                        <div class='price'>Rs.{$row['product_price']}</div>
                    </div>
                    <div class='icons'>
                    <form action='delete_from_cart.php' method='post'>
                        <button type='submit'>
                          <i class=' fa-solid fa-trash '></i>
                        </button>
                    </form>
                </div>
                </div>";
                         
                
            }
        } else {
            echo "<p>Your cart is empty!</p>";
        }
        ?>
        

    <section class="footer">
        <div class="credit">Created by <span>FootWear Nepal</span> | All Rights Reserved</div>
    </section>
</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>
