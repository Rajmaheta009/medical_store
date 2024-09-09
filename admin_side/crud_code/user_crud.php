<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // Hidden field for User ID
    $userName = $_POST['userName'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $check = $_POST['check'];
    $delete =$_POST['delete'];

    if ($check == 1 || $delete == 0){
        $check = True;
        $delete = False;
    }
    else{
        $check =False;
        $delete = True;
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

    if (!empty($password)) {
        // Hash the password before storing
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($userId)) {
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
