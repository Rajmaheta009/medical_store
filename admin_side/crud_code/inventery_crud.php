<?php
include '../../database/collaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productQuantity = isset($_POST['productQuantity']) ? (int) $_POST['productQuantity'] : null;
    $check = isset($_POST['check']) ? true : false;
    $delete = isset($_POST['delete']) && $_POST['delete'] == '1' ? true : false; // Check if delete flag is set to '1'
    $productExpiry = isset($_POST['productExpiry']) ? $_POST['productExpiry'] : null;

    // Handle delete operation directly if delete flag is true
    if ($delete) {
        $deleteProductId = $_POST['deleteProductId']; // Use the product ID from the delete button
        if ($deleteProductId) {
            $result = $inventery_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($deleteProductId)],  // Use inventory's ID
                ['$set' => ['delete' => true]]  // Set 'delete' flag to true
            );

            if ($result->getModifiedCount() > 0) {
                header("Location: ../inventery.php?status=success&type=delete");
            } else {
                header("Location: ../inventery.php?status=failed&type=delete");
            }
            exit();
        }
    }

    // Proceed with add or update functionality if delete is not set
    // Find the product in the product collection by name
    $product = $product_collection->findOne(['name' => $productName]);

    if ($product) {
        $productId = $product['_id'];

        // Check if there is already an inventory entry for this product
        $existingInventory = $inventery_collection->findOne(['product_id' => $productId]);

        if ($existingInventory) {
            // Handle update of quantity and expiry date
            $updateFields = [];

            if (!is_null($productQuantity)) {
                $updateFields['quantity'] = $productQuantity;
            }

            if (!is_null($productExpiry)) {
                $updateFields['expiry_date'] = new MongoDB\BSON\UTCDateTime(strtotime($productExpiry) * 1000);
            }

            if (!empty($updateFields)) {
                $inventery_collection->updateOne(
                    ['product_id' => $productId],
                    ['$set' => $updateFields]
                );
                $status = 'success';
                $type = 'edit';
            }

            header("Location: ../inventery.php?status=$status&type=$type");
            exit();
        } else {
            // If there is no existing inventory entry, insert a new one
            $inventery_collection->insertOne([
                'product_id' => $productId,
                'quantity' => $productQuantity,
                'selling_quantity' => 0,
                'check' => $check,
                'delete' => false,  // Set delete to false on new entry
                'expiry_date' => new MongoDB\BSON\UTCDateTime(strtotime($productExpiry) * 1000)
            ]);

            $status = 'success';
            $type = 'add';
            header("Location: ../inventery.php?status=$status&type=$type");
            exit();
        }
    } else {
        // Handle case where product was not found
        $status = 'failed';
        $type = 'add';
        header("Location: ../inventery.php?status=$status&type=$type");
        exit();
    }
}
