<?php
include '../../database/collaction.php';

if (isset($_GET['image_id'])) {
    $image_id = $_GET['image_id'];
    
    $bucket = $gridFS;
    $stream = $bucket->openDownloadStream(new MongoDB\BSON\ObjectId($image_id));

    if ($stream) {
        header('Content-Type: image/jpeg'); // Adjust the content type based on your image format
        fpassthru($stream);
    } else {
        http_response_code(404);
        echo 'Image not found.';
    }
} else {
    http_response_code(400);
    echo 'No image ID provided.';
}
