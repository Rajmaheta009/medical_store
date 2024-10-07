<?php
include '../../database/collaction.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        // Handle DELETE action
        if ($action === 'delete') {
            $productId = $_POST['product_id'] ?? null;
            if ($productId) {
                // Update the product's delete field to true
                $updateResult = $product_collection->updateOne(
                    ['_id' => new MongoDB\BSON\ObjectId($productId)],
                    ['$set' => ['delete' => true]]
                );

                if ($updateResult->getModifiedCount() > 0) {
                    header("Location: ../product.php?msg=Product+Deleted+Successfully");
                    exit();
                } else {
                    header("Location: ../product.php?error=Failed+to+delete+product");
                    exit();
                }
            }
        }

        // Handle ADD or EDIT action
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

        // Handle file upload if image is provided
        $image = '';
        if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $image = basename($_FILES['productImage']['name']);
            $targetDir = "../../assets/image/";
            $targetFile = $targetDir . $image;

            if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
                header("Location: ../product.php?error=Failed+to+upload+image");
                exit();
            }
        }

        if ($action === 'add') {
            // Inserting new product
            $insertResult = $product_collection->insertOne([
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
                'image' => $image
            ]);

            if ($insertResult->getInsertedCount() > 0) {
                header("Location: ../product.php?msg=Product+Added+Successfully");
                exit();
            }
        } elseif ($action === 'edit' && $productId) {
            // Updating existing product
            $updateFields = [
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
            ];

            if ($image) {
                $updateFields['image'] = $image; // Update image only if a new image was uploaded
            }

            $updateResult = $product_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($productId)],
                ['$set' => $updateFields]
            );

            if ($updateResult->getModifiedCount() > 0) {
                header("Location: ../product.php?msg=Product+Updated+Successfully");
                exit();
            }
        }
    }
} catch (Exception $e) {
    header("Location: ../product.php?error=" . urlencode($e->getMessage()));
    exit();
}
