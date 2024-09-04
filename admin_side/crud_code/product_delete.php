<?php
include '../database/collaction.php';

$productId = $_POST['product_id'] ?? null;

if ($productId) {
    $result = $product_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
    if ($result->getDeletedCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Product not found or already deleted']);
    }
} else {
    echo json_encode(['error' => 'No product ID provided']);
}
?>
