<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // Hidden field for User ID
    $userName = $_POST['userName'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare the user data
    $userData = [
        'name' => $userName,
        'phone' => $contactNo,
        'email' => $email,
        'role' => $role,
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
            echo '<script>alert("User updated successfully!"); window.location.href="../user.php";</script>';
        } else {
            echo '<script>alert("Update failed!"); window.location.href="../user.php";</script>';
        }
    } else {
        // Add new user
        $existingUser = $user_collection->findOne(['email' => $email]);
        
        if ($existingUser) {
            echo '<script>alert("Email already exists!"); window.location.href="../user.php";</script>';
        } else {
            $result = $user_collection->insertOne($userData);

            if ($result->getInsertedCount() > 0) {
                echo '<script>alert("User added successfully!"); window.location.href="../user.php";</script>';
            } else {
                echo '<script>alert("Add user failed!"); window.location.href="../user.php";</script>';
            }
        }
    }
}
?>
