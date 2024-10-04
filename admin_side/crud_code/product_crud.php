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

        // Retrieve the previously uploaded image from the database if the product exists
        if ($productId) {
            $existingProduct = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
            $p_upload_file = $existingProduct['image'] ?? 'assets/image/default.jpg';
        } else {
            $p_upload_file = 'assets/image/default.jpg';  // Default image for new products
        }

        // Handle image upload if a new image is uploaded
        $file_name = $_FILES['productImage']['name'] ?? '';
        $file_tmp_name = $_FILES['productImage']['tmp_name'] ?? '';
        $upload_dir = '../assets/image/';  // Ensure this path is correct
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['productImage']['type'] ?? '';

        // Validate file type and move the uploaded file
        if (!empty($file_name)) {
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception('Invalid file type. Only JPG, PNG, and GIF files are allowed.');
            }

            // Move the uploaded file to the target directory
            $target_file = $upload_dir . basename($file_name);
            if (move_uploaded_file($file_tmp_name, $target_file)) {
                $upload_file = $file_name;  // Use the new uploaded file name
            } else {
                throw new Exception('Failed to upload the file. Check the directory permissions.');
            }
        } else {
            // Use existing file if no new file is uploaded
            $upload_file = $p_upload_file;
        }

        // Check and delete logic
        $check = $check == 0 || $delete == 0 ? True : False;

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
            'delete' => false,
            'image' => $upload_file
        ];

        // Update or insert the product in the MongoDB collection
        if ($productId) {
            // Update the existing product
            $product_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($productId)],
                ['$set' => $product_data]
            );
        } else {
            // Insert a new product
            $product_collection->insertOne($product_data);
        }

        // Redirect or provide feedback after successful operation
        header('Location: ../product.php');
        exit();
    } else {
        throw new Exception('Product description is required.');
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
