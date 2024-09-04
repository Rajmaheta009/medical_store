<?php
include '../../database/collaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

include '../../database/collaction.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['productName'];
            $type = $_POST['productType'];
            $price = $_POST['productPrice'];
            $power = $_POST['productPower'];
            $pharmacy = $_POST['productPharmacy'];
            $gramMl = $_POST['editProductGramMl'];
            $sellingPrice = $_POST['editProductSellingPrice'];
            $description = $_POST['productDescription'];
            

    // Prepare the user data
    $productData = [
        'name' => $_POST['productName'],
            'type' => $_POST['productType'],
            'price' => $_POST['productPrice'],
            'power' => $_POST['productPower'],
            'pharmacy' => $_POST['productPharmacy'],
            'gramMl' => $_POST['editProductGramMl'],
            'sellingPrice' => $_POST['editProductSellingPrice'],
            'description' => $_POST['productDescription'],
            'image' => $image // Save image path
    ];


    if (!empty($productId)) {
        // Edit existing user
        $result = $user_collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($productId)],
            ['$set' => $productData]
        );

        if ($result->getModifiedCount() > 0) {
            header("Location: ../product.php?status=success&type=edit");
        } else {
            header("Location: ../product.php?status=failed&type=edit");
        }
    } else {
            $result = $user_collection->insertOne($productData);

            if ($result->getInsertedCount() > 0) {
                header("Location: ../product.php?status=success&type=add");
            } else {
                header("Location: ../product.php?status=failed&type=add");
            }
        }
    }
}
?>