<?php
require "db.php";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input data
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "
        <script type='text/javascript'>
            alert('Passwords do not match');
            window.location.href = 'register.html';
        </script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password); // "sss" means 3 string parameters

    try {
        // Execute the statement and check if successful
        if ($stmt->execute()) {
            $success_message = "Registration successful!". "<br>"."You can now log in.";
        } else {
            // Check for unique constraints (email or username already exists)
            if ($conn->errno === 1062) {
                $error_message = "Username or email already exists.";
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    } catch (Exception $e) {
        $error_message = "An error occurred: " . $e->getMessage();
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootWear Nepal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
       body {
            font-family: 'nunito', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .message {
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            border-radius: 8px;
            margin: 50px auto;
            width: 350px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .success {
            background-color: #4CAF50;
        }

        .error {
            background-color: #FF5252;
        }

        .message svg {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }

        .message p {
            margin: 0;
            font-weight: 500;
        }

        .message a {
            color: white;
            text-decoration: underline;
            font-weight: bold;
            transition: color 0.3s ease;
            margin-top: 10px;
        }

        .message a:hover {
            color: #dfffe1;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            color: white;
        }

        .footer .credit {
            font-size: 0.9rem;
            color: #999;
        }

        .footer .credit span {
            color: #ff9f1a;
        }
    </style>
</head>
<body>
    <div class="content">
        <?php if (!empty($success_message)): ?>
            <div class="message success">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9 12l2 2 4-4"></path>
                </svg>
                <p><?= $success_message; ?></p>
                <a href="login.html">Login Here</a>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="message error">
                <p><?= $error_message; ?></p>
                <a href="register.html">Try Again</a>
            </div>
        <?php endif; ?>
    </div>

    <section class="footer">
        <div class="credit">Created by <span>FootWear Nepal</span> | All Rights Reserved</div>
    </section>
</body>
</html>
