<?php
// Include database connection
include '../../database/collaction.php';

// Get the user ID from the query string
$product_typeId = $_GET['id'];

if ($product_typeId) {
    try {
        // Perform the delete operation
        $result = $product_type_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($product_typeId)]);

        // Check if the delete was successful
        if ($result->getDeletedCount() > 0) {
            header('Location: ../product_type.php'); // Redirect to the page with the table
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='../product_type.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "'); window.location.href='../product_type.php';</script>";
    }
} else {
    echo "<script>alert('No user ID provided.'); window.location.href='../product_type.php';</script>";
}
?>
