<?php
require_once 'classes/db.php';
require_once 'classes/category.php'; // If you need category data as well, if relevant for your brand

// Check if an edit_id is passed in the URL
if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];

    // Create a new instance of the db class and fetch the brand data
    $database = new db();
    $conn = $database->connect();

    // Fetch data for the specific brand
    $sql = "SELECT * FROM master_brand WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $editId, PDO::PARAM_INT);
    $stmt->execute();
    $editBrandData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
