<?php
include '../../database/collaction.php';

if (isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);

    $result = $inventery_collection->deleteOne(['_id' => $id]);

    if ($result->getDeletedCount() > 0) {
        $status = 'success';
        $type = 'delete';
    } else {
        $status = 'failed';
        $type = 'delete';
    }

    header("Location: ../inventery.php?status=$status&type=$type");
    exit();
}
