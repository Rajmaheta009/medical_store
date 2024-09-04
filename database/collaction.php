<?php
require 'vendor/autoload.php'; // Make sure this path is correct for your autoload.php

use MongoDB\Client;
// use MongoDB\BSON\ObjectID;

// MongoDB connection
$conn = new Client('mongodb://localhost:27017/?authSource=raj');

// Database and collection for 'raj'
$raj_database = $conn->selectDatabase('raj');
$user_collection_raj = $raj_database->selectCollection('user');
$emp_collection = $raj_database->selectCollection('employee');
$data_save_collection = $raj_database->selectCollection('data_save');

// Database and collection for 'medical_project'
$medical_project_database = $conn->selectDatabase('medical_project');
$login_registration_collection = $medical_project_database->selectCollection('login_registration');
$user_collection = $medical_project_database->selectCollection('medi_user');
$product_collection = $medical_project_database->selectCollection('medi_product');
$pharmacy_collection = $medical_project_database->selectCollection('medi_pharmacy');


// Database and collection for 'mydatabase'
$mydatabase_database = $conn->selectDatabase('mydatabase');
$mycollection_collection = $mydatabase_database->selectCollection('mycollection');
?>
