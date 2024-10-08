<?php
include '../../database/collaction.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        $check = isset($_POST['check']) ? true : false;
        $delete = $_POST['delete'] == 1 ? true : false;

        // Retrieve the previously uploaded image from the database if the product exists
        $p_upload_file = 'assets/image/default.jpg';  // Default image for new products
        if ($productId) {
            $existingProduct = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
            if ($existingProduct) {
                $p_upload_file = $existingProduct['image'] ?? $p_upload_file;
            }
        }

        // Handle image upload if a new image is uploaded
        $upload_file = $p_upload_file;  // Default to existing file
        if (!empty($_FILES['productImage']['name'])) {
            $file_name = $_FILES['productImage']['name'];
            $file_tmp_name = $_FILES['productImage']['tmp_name'];
            $upload_dir = '../assets/image/';
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['productImage']['type'];

            // Validate file type
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception('Invalid file type. Only JPG, PNG, and GIF files are allowed.');
            }

            // Move the uploaded file
            $target_file = $upload_dir . basename($file_name);
            if (!move_uploaded_file($file_tmp_name, $target_file)) {
                throw new Exception('Failed to upload the file. Check the directory permissions.');
            }
            $upload_file = $file_name;  // Use the new uploaded file name
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
            'image' => $upload_file
        ];

        // Update or insert the product in the MongoDB collection
        if (!empty($productId)) {
            // Update the existing product
            if ($delete) {
                // Delete the product if the delete flag is set
                $result = $product_collection->updateOne(
                    ['_id' => new MongoDB\BSON\ObjectID($productId)],
                    ['$set' => ['delete' => true]]
                );
                if ($result->getModifiedCount() > 0) {
                    header("Location: ../product.php?status=success&type=delete");
                } else {
                    header("Location: ../product.php?status=failed&type=delete");
                }
                exit();  // Ensure that the script stops after the deletion
            } else {
                // Proceed with the update operation if not deleting
                $product_collection->updateOne(
                    ['_id' => new MongoDB\BSON\ObjectId($productId)],
                    ['$set' => $product_data]
                );
                if ($result->getModifiedCount() > 0) {
                    header("Location: ../product.php?status=success&type=edit");
                } else {
                    header("Location: ../product.php?status=failed&type=edit");
                }
            }
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
