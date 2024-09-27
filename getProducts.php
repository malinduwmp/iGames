<?php
require "connection.php";

// Fetch products from database
$product_rs = Database::search("SELECT * FROM product");
$products = [];

while ($row = $product_rs->fetch_assoc()) {
    $products[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'price' => $row['price'],
        'image' => $row['image']
    ];
}

echo json_encode(['products' => $products]);
?>
