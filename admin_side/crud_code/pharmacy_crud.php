<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pharmacyId = $_POST['pharmacyId']; // Hidden field for User ID
    $pharmacy = $_POST['name'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = isset($_POST['check']) ? true : false;
    $delete = $_POST['delete'] == 1 ? true : false;
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? true : false; // Convert status to boolean
    // Prepare the user data
    $pharmacyData = [
        'name' => $pharmacy,
        'phone' => $contactNo,
        'email' => $email,
        'status' => $status,
        'check' => $check,
        'delete' => $delete,
    ];

    if (!empty($password)) {
        // Hash the password before storing
        $pharmacyData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($pharmacyId)) {
        if ($delete == false) {
            $result = $pharmacy_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($pharmacyId)],
                ['$set' => ['delete' => true]]
            );
            if ($result->getModifiedCount() > 0) {
                header("Location: ../pharmacy.php?status=success&type=delete");
            } else {
                header("Location: ../pharmacy.php?status=failed&type=delete");
            }
        } else {
            // Edit existing user
            $result = $pharmacy_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($pharmacyId)],
                ['$set' => $pharmacyData]
            );
            if ($result->getModifiedCount() > 0) {
                header("Location: ../pharmacy.php?status=success&type=edit");
            } else {
                header("Location: ../pharmacy.php?status=failed&type=edit");
            }
        }
    } else {
        // Add new user
        $existingUser = $pharmacy_collection->findOne(['email' => $email]);

        if ($existingUser) {
            header("Location: ../pharmacy.php?status=failed&type=email_exists");
        } else {
            $result = $pharmacy_collection->insertOne($pharmacyData);
            if ($result->getInsertedCount() > 0) {
                header("Location: ../pharmacy.php?status=success&type=add");
            } else {
                header("Location: ../pharmacy.php?status=failed&type=add");
            }
        }
    }
}
