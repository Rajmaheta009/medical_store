<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // Hidden field for User ID
    $userName = $_POST['userName'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $check = isset($_POST['check']) ? true : false; // Convert checkbox value to boolean

    // Initialize delete flag to false
    $delete = false;

    // Determine if we should mark the user as deleted
    if (isset($_POST['delete']) && $_POST['delete'] == '1') {
        $delete = true; // Set delete to true if the delete checkbox is checked
    }

    // Prepare the user data
    $userData = [
        'name' => $userName,
        'phone' => $contactNo,
        'email' => $email,
        'role' => $role,
        'check' => $check,
        'delete' => $delete,
    ];

    // Hash the password only if it is provided
    if (!empty($password)) {
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($userId) && MongoDB\BSON\ObjectId::isValid($userId)) {
        // Edit existing user
        $result = $user_collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($userId)],
            ['$set' => $userData]
        );

        if ($result->getModifiedCount() > 0) {
            header("Location: ../user.php?status=success&type=edit");
            exit;
        } else {
            header("Location: ../user.php?status=failed&type=edit");
            exit;
        }
    } else {
        // Add new user
        $existingUser = $user_collection->findOne(['email' => $email]);

        if ($existingUser) {
            header("Location: ../user.php?status=failed&type=email_exists");
            exit;
        } else {
            $result = $user_collection->insertOne($userData);

            if ($result->getInsertedCount() > 0) {
                header("Location: ../user.php?status=success&type=add");
                exit;
            } else {
                header("Location: ../user.php?status=failed&type=add");
                exit;
            }
        }
    }
}
