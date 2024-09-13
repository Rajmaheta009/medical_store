<?php
include '../../database/collaction.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['productdescription'])) {

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

        // Retrieve the previously uploaded image from the database if product exists
        if ($productId) {
            $existingProduct = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
            $p_upload_file = $existingProduct['image'] ?? '/assets/image/default.jpg';
        } else {
            $p_upload_file = 'assets/image/default.jpg';
        }

        $file_name = $_FILES['productImage']['name'] ?? '';
        $file_tmp_name = $_FILES['productImage']['tmp_name'] ?? '';
        $upload_dir = '/assets/image/';  // Ensure this path is correct
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['productImage']['type'] ?? '';

        // Validate file type
        if (!empty($file_name) && !in_array($file_type, $allowed_types)) {
            throw new Exception('Invalid file type. Only JPG, PNG, and GIF files are allowed.');
        }

        // Process the file upload
        if (!empty($file_name)) {
            $upload_file = $upload_dir . basename($file_name);
            if (!move_uploaded_file($file_tmp_name, $upload_file)) {
                throw new Exception('Failed to move uploaded file.');
            }
        } else {
            $upload_file = $p_upload_file; // Use the previous image if no new file is uploaded
        }

        // Check and delete logic
        $check = ($check == 1 || $delete == 0) ? True : False;
        $delete = !$check;

        // Prepare product data
        $product_data = [
            'name' => $name,
            'type' => $type,
            'price' => $price ?? 0,
            'power' => $power,
            'pharmacy' => $pharmacy,
            'gram_ml' => $gram_ml ?? 0,
            'selling_price' => $selling_price ?? 0,
            'description' => $description,
            'check' => $check,
            'delete' => $delete,
            'image' => $upload_file
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
