<?php
include '../../database/collaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productQuantity = (int) $_POST['productQuantity'];
    $check = $_POST['check'];
    $delete = $_POST['delete'];
    $productExpiry = $_POST['productExpiry'];

    $product = $product_collection->findOne(['name' => $productName]);

    if ($check == 1 || $delete == 0){
        $check = True;
        $delete = False;
    }
    else{
        $check =False;
        $delete = True;
    }

    if ($product) {
        $productId = $product['_id'];

        $existingInventory = $inventery_collection->findOne(['product_id' => $productId]);

        if ($existingInventory) {
            $inventery_collection->updateOne(
                ['product_id' => $productId],
                ['$set' => [
                    'quantity' => $productQuantity,
                    'expiry_date' => new MongoDB\BSON\UTCDateTime(strtotime($productExpiry) * 1000)
                ]]
            );
            $status = 'success';
            $type = 'edit';
        } else {
            $inventery_collection->insertOne([
                'product_id' => $productId,
                'quantity' => $productQuantity,
                'selling_quantity' => 0,
                'check' => $check,
                'delete' => $delete,
                'expiry_date' => new MongoDB\BSON\UTCDateTime(strtotime($productExpiry) * 1000)
            ]);
            $status = 'success';
            $type = 'add';
        }

        header("Location:../inventery.php?status=$status&type=$type");
        exit();
    } else {
        $status = 'failed';
        $type = 'add';
        header("Location:../inventery.php?status=$status&type=$type");
        exit();
    }
}
