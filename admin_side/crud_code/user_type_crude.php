<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_typeId = $_POST['user_typeId'];
    // echo $product_typeId; // Hidden field for User ID
    $role = $_POST['role'];
    $check = $_POST['check'];
    $status = isset($_POST['status']) && $_POST['status'] === '1' ? true : false; // Convert status to boolean

    if ($check == 1){
        $check = True;
    }
    else{
        $check =False;
    }
    // Prepare the user data
    $user_typeData = [
        'status' => $status,
        'check' => $check,
        'role' => $role,
    ];
    if (!empty($user_typeId)) {
        // Edit existing user
        $result = $user_type_collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($user_typeId)],
            ['$set' => $user_typeData]
        );

        if ($result->getModifiedCount() > 0) {
            header("Location: ../user_type.php?status=success&type=edit");
        } else {
            header("Location: ../user_type.php?status=failed&type=edit");
        }
    } else {
        $result = $user_type_collection->insertOne($user_typeData);
        if ($result->getInsertedCount() > 0) {
            header("Location: ../user_type.php?status=success&type=add");
        } else {
            header("Location: ../user_type.php?status=failed&type=add");
        }
    }
}
