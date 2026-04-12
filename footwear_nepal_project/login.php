<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($username) || empty($password)) {
        
        echo '<script type="text/javascript">
              alert("Both username and password are required.");  
          window.location.href = "login.html";
             </script>';
        exit();
    }

    // Prepare SQL query to fetch user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Validate user existence and password
    if (!$user && !password_verify($password, $user['password_hash'])) {
        echo '<script type="text/javascript">
                alert("Invalid username or password");
                window.location.href = "login.html";
              </script>';
        exit();
    }
      else{
         $_SESSION['user'] = $user['username'];
        echo '<script>
                alert("Login Successful");
                window.location.href = "index.php";
              </script>';
        exit();
    }
    }
   

    


// Close database connection
$conn->close();
?>
