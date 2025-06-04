<?php
require_once "dbconfig.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $imageName = $id . ".jpeg";

    if (!empty($_FILES['image']['name']) && $_FILES['image']['type'] === "image/jpeg") {
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $imageName);
    }

    $stmt = $pdo->prepare("UPDATE products SET description = :desc, price = :price, quantity = :qty WHERE id = :id");
    $stmt->execute([
        ':desc' => $desc,
        ':price' => $price,
        ':qty' => $quantity,
        ':id' => $id
    ]);

    header("Location: products.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Missing product ID.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Product</title></head>
<body>
<header><h2>Edit Product</h2></header>

<main>
    <form method="POST" enctype="multipart/form-data" action="edit.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <p>Name: <?= htmlspecialchars($product['name']) ?></p>
        <p>Category: <?= htmlspecialchars($product['category']) ?></p>
        <p><label>Description: <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea></label></p>
        <p><label>Price: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>"></label></p>
        <p><label>Quantity: <input type="number" name="quantity" value="<?= $product['quantity'] ?>"></label></p>
        <p><label>Replace Image: <input type="file" name="image" accept="image/jpeg"></label></p>
        <p><button type="submit">Update Product</button></p>
    </form>
</main>

<footer>
    <p><a href="products.php">Back to Products</a></p>
</footer>
</body>
</html>
