<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId']; // Hidden field for User ID
    $productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    $productExpiry = $_POST['productExpiry'];

    // Prepare the user data
    $inveteryData = [
        'productName' => $productName,
        'productQuantity' => $productQuantity,
        'productExpiry' => $productExpiry,
    ];

    if (!empty($password)) {
        // Hash the password before storing
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($productId)) {
        // Edit existing user
        $result = $inventery_collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($userId)],
            ['$set' => $inveteryData]
        );

        if ($result->getModifiedCount() > 0) {
            header("Location: ../inventery.php?status=success&type=edit");
        } else {
            header("Location: ../inventery.php?status=failed&type=edit");
        }
    } else {
        // Add new user
        $existingUser = $user_collection->findOne(['email' => $email]);

        if ($existingUser) {
            header("Location: ../inventery.php?status=failed&type=email_exists");
        } else {
            $result = $user_collection->insertOne($userData);

            if ($result->getInsertedCount() > 0) {
                header("Location: ../inventery.php?status=success&type=add");
            } else {
                header("Location: ../inventery.php?status=failed&type=add");
            }
        }
    }
}
