<?php
require_once "dbconfig.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $quantity = $_POST['quantity'];

    $imageName = $id . ".jpeg";
    $imagePath = "images/" . $imageName;

    if ($_FILES['image']['type'] === "image/jpeg") {
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

        $stmt = $pdo->prepare("INSERT INTO products (id, name, category, description, price, rating, quantity, image) 
            VALUES (:id, :name, :category, :description, :price, :rating, :quantity, :image)");
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':category' => $category,
            ':description' => $description,
            ':price' => $price,
            ':rating' => $rating,
            ':quantity' => $quantity,
            ':image' => $imageName
        ]);

        header("Location: products.php");
        exit;
    } else {
        echo "Only JPEG images are allowed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Product</title></head>
<body>
<header>
    <h2>Add New Product</h2>
</header>

<main>
    <form method="POST" enctype="multipart/form-data" action="add.php">
        <p><label>ID: <input type="text" name="id" required></label></p>
        <p><label>Name: <input type="text" name="name" required></label></p>
        <p><label>Category: <input type="text" name="category" required></label></p>
        <p><label>Description: <textarea name="description" required></textarea></label></p>
        <p><label>Price: <input type="number" step="0.01" name="price" required></label></p>
        <p><label>Rating: <input type="number" step="0.1" name="rating" required></label></p>
        <p><label>Quantity: <input type="number" name="quantity" required></label></p>
        <p><label>Image (JPEG only): <input type="file" name="image" accept="image/jpeg" required></label></p>
        <p><button type="submit">Add Product</button></p>
    </form>
</main>

<footer>
    <p>Back to <a href="products.php">Products</a></p>
</footer>
</body>
</html>
