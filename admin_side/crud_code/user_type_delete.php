<?php
// Include database connection
include '../../database/collaction.php';

// Get the user ID from the query string
$user_typeId = $_GET['id'];

if ($user_typeId) {
    try {
        // Perform the delete operation
        $result = $user_type_collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($user_typeId)]);

        // Check if the delete was successful
        if ($result->getDeletedCount() > 0) {
            header('Location: ../user_type.php'); // Redirect to the page with the table
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='../user_type.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "'); window.location.href='../user_type.php';</script>";
    }
} else {
    echo "<script>alert('No user ID provided.'); window.location.href='../user_type.php';</script>";
}
?>
