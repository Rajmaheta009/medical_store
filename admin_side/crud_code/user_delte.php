<?php
// Include database connection
include '../../database/collaction.php';

// Get the user ID from the query string
$userId = $_GET['id'];

if ($userId) {
    try {
        // Perform the delete operation
        $result = $user_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);

        // Check if the delete was successful
        if ($result->getDeletedCount() > 0) {
            header('Location: ../user.php'); // Redirect to the page with the table
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='../user.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "'); window.location.href='../user.php';</script>";
    }
} else {
    echo "<script>alert('No user ID provided.'); window.location.href='../user.php';</script>";
}
?>
