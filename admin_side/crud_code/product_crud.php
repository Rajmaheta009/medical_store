<?php
include '../../database/collaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = $_POST['product_id'] ?? ''; // Ensure productId is provided
    $action = $_POST['action'] ?? ''; // Ensure action is provided

    
if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['productImage']['tmp_name'];
    $fileName = $_FILES['productImage']['name'];
    $fileSize = $_FILES['productImage']['size'];
    $fileType = $_FILES['productImage']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileExtension, $allowedExts)) {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../uploads/';
        $destPath = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $imagePath = $destPath;
        } else {
            echo json_encode(['error' => 'There was an error moving the uploaded file.']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'Upload failed. Allowed file types: jpg, jpeg, png, gif.']);
        exit;
    }
} else {
    $imagePath = $_POST['existingImage'] ?? ''; // Use existing image if no new file uploaded
}

    if ($action === 'add') {
        $result = $product_collection->insertOne([
            'name' => $_POST['productName'],
            'type' => $_POST['productType'],
            'price' => $_POST['productPrice'],
            'power' => $_POST['productPower'],
            'pharmacy' => $_POST['productPharmacy'],
            'gramMl' => $_POST['editProductGramMl'],
            'sellingPrice' => $_POST['editProductSellingPrice'],
            'description' => $_POST['productDescription'],
            'image' => $image // Save image path
        ]);

        if ($result->getInsertedCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to add product.']);
        }
    } elseif ($action === 'edit') {
        // Ensure the productId is valid
        if (!empty($productId)) {
            $updateData = [
                'name' => $_POST['productName'],
                'type' => $_POST['productType'],
                'price' => $_POST['productPrice'],
                'power' => $_POST['productPower'],
                'pharmacy' => $_POST['productPharmacy'],
                'gramMl' => $_POST['editProductGramMl'],
                'sellingPrice' => $_POST['editProductSellingPrice'],
                'description' => $_POST['productDescription'],
            ];

            // If a new image is uploaded, include it in the update
            if (!empty($image)) {
                $updateData['image'] = $image;
            }

            $result = $product_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($productId)],
                ['$set' => $updateData]
            );

            if ($result->getModifiedCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Failed to update product.']);
            }
        } else {
            echo json_encode(['error' => 'Invalid Product ID.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid action.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
