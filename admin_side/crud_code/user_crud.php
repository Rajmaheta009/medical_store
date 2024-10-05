<?php
include '../../database/collaction.php'; // Adjust the path as necessary
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // Hidden field for User ID
    $userName = $_POST['userName'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $check = isset($_POST['check']) ? true : false;
    $delete = $_POST['delete'] == 1 ? true : false;

    // Prepare the user data
    $userData = [
        'name' => $userName,
        'phone' => $contactNo,
        'email' => $email,
        'role' => $role,
        'check' => $check,  // This will be true by default unless unchecked
        'delete' => $delete, // This is set to true only for delete actions
    ];

    // Only hash the password if it's provided (for edits)
    if (!empty($password)) {
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($userId)) {
        // If delete flag is true, we proceed with a soft delete
        if ($delete) {
            $result = $user_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($userId)],
                ['$set' => ['delete' => true]]
            );
            if ($result->getModifiedCount() > 0) {
                header("Location: ../user.php?status=success&type=delete");
            } else {
                header("Location: ../user.php?status=failed&type=delete");
            }
        } else {
            // Edit existing user
            $result = $user_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($userId)],
                ['$set' => $userData]
            );
            if ($result->getModifiedCount() > 0) {
                header("Location: ../user.php?status=success&type=edit");
            } else {
                header("Location: ../user.php?status=failed&type=edit");
            }
        }
    } else {
        // Add new user
        $existingUser = $user_collection->findOne(['email' => $email]);

        if ($existingUser) {
            header("Location: ../user.php?status=failed&type=email_exists");
        } else {
            $result = $user_collection->insertOne($userData);
            if ($result->getInsertedCount() > 0) {
                header("Location: ../user.php?status=success&type=add");
            } else {
                header("Location: ../user.php?status=failed&type=add");
            }
        }
    }
}
?>