<?php

require "db.php";

session_start(); 

if (!isset($_SESSION['user'])) {
   
    echo '<script type="text/javascript">
                alert("You are not logged in .Please login");
                window.location.href = "login.html"; 
         </script>';
    exit();
}
//atabase connection



// Fetch user details from the database
$current_user = $_SESSION['user'];
$sql = "SELECT username, email, created_at FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footwear Nepal</title>
    <style>
       *{
    font-family: 'Nunito', sans-serif;
  margin: 0; padding:0;
  box-sizing: border-box;
  outline: none; border:none;
  text-decoration: none;
  text-transform: capitalize;
  transition: all .2s linear;
}


body{
    width: 100%;
    height: 100vh;
    background-repeat: no-repeat;
    background: #f9f9f9;
}

header{
    position: fixed;
    top:0; left:0; right:0;
    z-index: 1000;
    background:#fff;
    padding:2rem 9%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
  }

  header .icons a{
    font-size: 1.8rem;
    color:#2c2c54;
margin-left:1.5rem;
  }

  header .icons a:hover{
    color:#ff9f1a;
  }

  .account-container {
            margin-top: 200px;  /* Adds space between the header and the container */
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            max-width: 600px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;

        }
        .account-header {
    background-color: #0a0d88;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    color: #fff;
    display: flex; /* Use flexbox for alignment */
    align-items: center; /* Vertically center content */
    padding: 30px;
    font-size: 24px;
    margin-bottom: 10px;
}

.account-header img {
    border-radius: 50%;
    object-fit: cover;
    height: 5rem;
    width: 5rem;
    margin-right: 20px; /* Add spacing between the image and text */
}

.account-header .user {
    flex: 1; /* Take up remaining space */
    text-align: center; /* Center the text horizontally */
    font-size: 1.5rem; /* Adjust font size for better visibility */
}

}
        .account-content {
            padding: 20px;
        }
        .account-content p {
            margin: 10px 0;
            font-size: 18px;
            margin-top: 2rem;
        }
        .logout-button {
            display: block ;

            margin: 20px auto;
            text-align: center;
           color: #2c2c54;
       font-weight: 600;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            border-top: .1rem solid rgba(5, 5, 5, 0.1);

            transition: background 0.3s ease;
        }
        .logout-button:hover {
            background: #e40a0a;
            color: #fff;
        }
        .footer .credit{
           text-align: center;
            width:100%;
  
            font-size: 0.9rem;
          padding:0.2rem;
           padding-top:6rem;
           color:#999;
          }
  
.footer .credit span{
    color:#ff9f1a;
  }
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <script>
    function confirmLogout(event) {
      // Show confirmation dialog
      const userConfirmed = confirm('Are you sure you want to log out?');

      // If the user cancels, prevent the default action (e.g., navigation or form submission)
      if (!userConfirmed) {
        event.preventDefault();
        console.log('Logout canceled');
      }
    }
  </script>

</head>
<body>
<header>
        <a href="#"><img src="images/logo.png"  height="65" width="65" class="logo" alt=""></a>
        <div class="icons">
            <a href="index.php" class="fas fa-home"></a>
        </div>
</header>
    <div class="account-container">
        <div class="account-header">
            <img src="images/user1.png" alt="">

            <div class= "user"> <?php echo htmlspecialchars($user['username']);?> </div>
        </div>
        <div class="account-content">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Registered on:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>

        <a href="logout.php" onclick="confirmLogout(event)" class="logout-button">LOG OUT</a>
    </div>
    <div class="footer">
        <div class="credit">Created by <span>FootWear Nepal</span> | All Rights Reserved</div>
</div>

</body>
</html>
