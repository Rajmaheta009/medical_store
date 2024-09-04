<?php
include '../../database/collaction.php';

$productId = $_GET['id'] ?? null;

if ($productId) {
    $product = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'No product ID provided']);
}
?>
