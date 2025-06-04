<?php
require_once "dbconfig.inc.php";
require_once "Product.php";

if (!isset($_GET['id'])) die("Invalid request.");

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $_GET['id']]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) die("Product not found.");

$p = new Product($product['id'], $product['name'], $product['category'], $product['description'], $product['price'], $product['rating'], $product['image']);
echo $p->displayProductPage();
?>
