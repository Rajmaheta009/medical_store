<?php
include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_typeId = $_POST['product_typeId'];
    echo $product_typeId; // Hidden field for User ID
    $type = $_POST['type'];
    $check = $_POST['check'];
    $status = isset($_POST['status']) && $_POST['status'] === '1' ? true : false; // Convert status to boolean


    if ($check == 1){
        $check = True;
    }
    else{
        $check =False;
    }
    // Prepare the user data
    $product_typeData = [
        'type' => $type,
        'check' => $check,
        'status' => $status,
    ];
    if (!empty($product_typeId)) {
        // Edit existing user
        $result = $product_type_collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($product_typeId)],
            ['$set' => $product_typeData]
        );

        if ($result->getModifiedCount() > 0) {
            header("Location: ../product_type.php?status=success&type=edit");
        } else {
            header("Location: ../product_type.php?status=failed&type=edit");
        }
    } else {
        $result = $product_type_collection->insertOne($product_typeData);
        if ($result->getInsertedCount() > 0) {
            header("Location: ../product_type.php?status=success&type=add");
        } else {
            header("Location: ../product_type.php?status=failed&type=add");
        }
    }
}
