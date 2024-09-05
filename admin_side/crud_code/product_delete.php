<?php
include '../../database/collaction.php'; // Ensure this is correct

$productId = $_GET['id'];
if ($productId){
    try {
        // Delete product logic
        $result = $product_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
        // Check if the delete was successful
        if ($result->getDeletedCount() > 0) {
            header('Location: ../product.php'); // Redirect to the page with the table
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='../product.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "'); window.location.href='../product.php';</script>";
    }
} else {
    echo "<script>alert('No product ID provided.'); window.location.href='../product.php';</script>";
}
?>