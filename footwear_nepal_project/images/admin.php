<?php
// Start session for admin login check
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "footwear_nepal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        $sql = "INSERT INTO products (name, price, category, description) VALUES ('$name', '$price', '$category', '$description')";
        $conn->query($sql);
    } elseif (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM products WHERE id='$product_id'";
        $conn->query($sql);
    }
}

// Fetch all products
$result = $conn->query("SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footwear Nepal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-top: 20px;
        }
        .btn {
            padding: 8px 12px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
        }
        .btn-add { background-color: green; color: white; }
        .btn-delete { background-color: red; color: white; }
    </style>
</head>
<body>

<h1>Admin Panel - Footwear Nepal</h1>

<h2>Manage Products</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['price']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                    <button type="submit" name="delete_product" class="btn btn-delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h3>Add New Product</h3>
<form method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" required><br><br>

    <label for="category">Category:</label><br>
    <input type="text" id="category" name="category" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="4" required></textarea><br><br>

    <button type="submit" name="add_product" class="btn btn-add">Add Product</button>
</form>

</body>
</html>

<?php $conn->close(); ?>
