<?php
include '../../database/collaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $name = $_POST['productname'];
    $type = $_POST['productType'];
    $price = $_POST['productprice'];
    $power = $_POST['productpower'];
    $pharmacy = $_POST['productpharmacy'];
    $gram_ml = $_POST['editProductGramMl'];
    $selling_price = $_POST['editProductSellingPrice'];
    $description = $_POST['productDescription'];

    // Check if the request is to update an existing product
    if (isset($productId) && !empty($productId)) {
        $card = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);

        if ($card) {
            $image_id = $card['image_id']; // Retain the old image ID by default

            if (isset($_FILES['productImage']) && $_FILES['productImage']['size'] > 0) {
                // Delete old image from GridFS
                $gridFS->delete($image_id);

                // Upload new image
                $file = $_FILES['productImage']['tmp_name'];
                $filename = $_FILES['productImage']['name'];
                $stream = fopen($file, 'rb');
                $new_image_id = $gridFS->uploadFromStream($filename, $stream);
                fclose($stream);

                // Update image reference
                $image_id = $new_image_id;
            }

            // Update product details
            $product_collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($productId)],
                ['$set' => [
                    'name' => $name,
                    'type' => $type,
                    'price' => $price,
                    'power' => $power,
                    'pharmacy' => $pharmacy,
                    'gram_ml' => $gram_ml,
                    'selling_price' => $selling_price,
                    'description' => $description,
                    'image_id' => $image_id
                ]]
            );
            header("Location: ../product.php?status=success&type=edit");
        } else {
            header("Location: ../product.php?status=failed&type=edit");
        }
    } else {
        // Adding new product
        if (isset($_FILES['productImage']) && $_FILES['productImage']['size'] > 0) {
            $file = $_FILES['productImage']['tmp_name'];
            $filename = $_FILES['productImage']['name'];

            // Upload image to GridFS
            $stream = fopen($file, 'rb');
            $image_id = $gridFS->uploadFromStream($filename, $stream);
            fclose($stream);

            // Insert new product details into MongoDB
            $product = [
                "name" => $name,
                "type" => $type,
                "price" => $price,
                "power" => $power,
                "pharmacy" => $pharmacy,
                "gram_ml" => $gram_ml,
                "selling_price" => $selling_price,
                "description" => $description,
                "image_id" => $image_id
            ];

            $product_collection->insertOne($product);
            header("Location: ../product.php?status=success&type=add");
        } else {
            header("Location: ../product.php?status=failed&type=add");
        }
    }
}
?>
