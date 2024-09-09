<?php
include '../../database/collaction.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['productdescription'] != null) {
        // Validate and sanitize input fields
        $productId = $_POST['product_id'] ?? null;
        $name = htmlspecialchars(trim($_POST['productname']));
        $type = htmlspecialchars(trim($_POST['productType']));
        $price = filter_var($_POST['productprice'], FILTER_VALIDATE_FLOAT);
        $power = htmlspecialchars(trim($_POST['productpower']));
        $pharmacy = htmlspecialchars(trim($_POST['productpharmacy']));
        $gram_ml = filter_var($_POST['editProductGramMl'], FILTER_VALIDATE_FLOAT);
        $selling_price = filter_var($_POST['editProductSellingPrice'], FILTER_VALIDATE_FLOAT);
        $description = htmlspecialchars(trim($_POST['productdescription']));
        $check = htmlspecialchars(trim($_POST['check']));
        $delete = htmlspecialchars(trim($_POST['delete']));

        $file_name = $_FILES['productImage']['name'] ?? '';
        $file_tmp_name = $_FILES['productImage']['tmp_name'] ?? '';
        $upload_dir = '../assets/image/';  // Ensure this path is correct
        $upload_file = $upload_dir . basename($file_name);

        // Validate file upload
        if ($file_name && $file_tmp_name) {
            // Check file upload errors
            if ($_FILES['productImage']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Error uploading file.');
            }

            // Move the uploaded file to the destination directory
            if (!move_uploaded_file($file_tmp_name, $upload_file)) {
                throw new Exception('Failed to move uploaded file.');
            }
        }

        if ($check == 1 || $delete == 0){
            $check = True;
            $delete = False;
        }
        else{
            $check =False;
            $delete = True;
        }
        // Prepare product data
        $product_data = [
            'name' => $name,
            'type' => $type,
            'price' => $price,
            'power' => $power,
            'pharmacy' => $pharmacy,
            'gram_ml' => $gram_ml,
            'selling_price' => $selling_price,
            'description' => $description,
            'check' => $check,
            'delete' => $delete,
            'image' => $file_name // This will be an empty string if no file was uploaded
        ];

        if ($productId) {
            // Update existing product
            $result = $product_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($productId)],
                ['$set' => $product_data]
            );

            if ($result->getModifiedCount() === 0) {
                throw new Exception('Product not found or no changes made.');
            }

            $status = 'success&type=edit';
        } else {
            // Insert new product
            $product_collection->insertOne($product_data);
            $status = 'success&type=add';
        }

        header("Location: ../product.php?status=$status");
        exit();
    }
} catch (Exception $e) {
    // Log error and redirect with failure status
    error_log($e->getMessage());
    header("Location: ../product.php?status=failed&type=" . (isset($productId) ? 'edit' : 'add'));
    exit();
}
