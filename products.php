<?php
require_once "dbconfig.inc.php";
require_once "Product.php";

$query = "SELECT * FROM products";
$conditions = [];
$params = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['name'])) {
        $conditions[] = "name LIKE :name";
        $params[':name'] = '%' . $_POST['name'] . '%';
    }
    if (!empty($_POST['price'])) {
        $conditions[] = "price <= :price";
        $params[':price'] = $_POST['price'];
    }
    if (!empty($_POST['category']) && $_POST['category'] != "All") {
        $conditions[] = "category = :category";
        $params[':category'] = $_POST['category'];
    }

    if ($conditions) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products Page</title>
</head>
<body>

<header>
    <h2>To Add a new Product click on the following link <a href="add.php">Add Product</a>.</h2>
    <p>Or use the actions below to edit or delete a Product’s record.</p>
</header>

<section>
    <p><strong>— Advanced Product Search</strong></p>
    <form method="POST" action="products.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" placeholder="Product Name"></td>
                <td>Price</td>
                <td><input type="number" name="price" placeholder="Product Price" step="0.01"></td>
                <td>Category</td>
                <td>
                    <select name="category">
                        <option value="All">Select Category</option>
                        <option value="Sweater">Sweater</option>
                        <option value="Formal Shirt">Formal Shirt</option>
                        <option value="T-Shirt">T-Shirt</option>
                        <!-- Add more categories as needed -->
                    </select>
                </td>
                <td><button type="submit">🔍 Filter</button></td>
            </tr>
        </table>
    </form>
</section>

<section>
    <h3>Products Table Result</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Product Image</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($products as $row): ?>
            <tr>
                <td><img src="images/<?= htmlspecialchars($row['image']) ?>" alt="Product" width="80"></td>
                <td><a href="view.php?id=<?= $row['id'] ?>"><?= $row['id'] ?></a></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td>
                    <button><a href="edit.php?id=<?= $row['id'] ?>"><img src="icons/edit.png" width="20" alt="Edit"></a></button>
                    <button><a href="delete.php?id=<?= $row['id'] ?>"><img src="icons/delete.png" width="20" alt="Delete"></a></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<footer>
    <figcaption><i>Figure 1: products.php</i></figcaption>
</footer>

</body>
</html>
