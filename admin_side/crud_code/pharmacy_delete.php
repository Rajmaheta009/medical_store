<?php
// Include database connection
include '../../database/collaction.php';

// Get the user ID from the query string
$pharmacyId = $_GET['id'];

if ($pharmacyId) {
    try {
        // Perform the delete operation
        $result = $pharmacy_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($pharmacyId)]);

        // Check if the delete was successful
        if ($result->getDeletedCount() > 0) {
            header('Location: ../pharmacy.php'); // Redirect to the page with the table
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='../pharmacy.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "'); window.location.href='../pharmacy.php';</script>";
    }
} else {
    echo "<script>alert('No user ID provided.'); window.location.href='../pharmacy.php';</script>";
}
?>
