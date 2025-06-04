<?php
require_once "dbconfig.inc.php";

if (!isset($_GET['id'])) die("No ID provided");

$stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
$stmt->execute([':id' => $_GET['id']]);

$image = "images/{$_GET['id']}.jpeg";
if (file_exists($image)) unlink($image);

header("Location: products.php");
exit;
?>
