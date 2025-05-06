<?php
require_once "classes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $editBrandId = $_POST['editBrandId'];
    $editBrandCode = $_POST['editBrandCode'];
    $editBrandName = $_POST['editBrandName'];
    $editBrandStatus = $_POST['editBrandStatus'];

    // Database connection
    $database = new db();
    $conn = $database->connect();

    // Prepare the update query
    $sql = "UPDATE master_brand SET code = :code, name = :name, status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':code', $editBrandCode);
    $stmt->bindParam(':name', $editBrandName);
    $stmt->bindParam(':status', $editBrandStatus);
    $stmt->bindParam(':id', $editBrandId, PDO::PARAM_INT);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: brand_management.php?message=Brand+updated+successfully");
        exit();
    } else {
        // Handle error
        echo "Error updating brand.";
    }
}
?>
