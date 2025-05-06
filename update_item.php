<?php

require_once 'classes/item.php';

$item = new Item();

// Retrieve POST data
$id = $_POST['item_id'];  // Use the actual ID field
$brand_id = $_POST['brand_id'];
$category_id = $_POST['category_id'];
$code = $_POST['code'];
$name = $_POST['name'];
$status = $_POST['status'];

// Update the item in the database
$success = $item->update($id, $brand_id, $category_id, $code, $name, $status);

// Redirect or show result based on success
if ($success) {
    header("Location: item_management.php?message=success");
} else {
    header("Location: item_management.php?message=error");
    exit;
}


?>