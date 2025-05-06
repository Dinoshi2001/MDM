<?php

include('classes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $brand_id = $_POST['brand_id'];
    $category_id = $_POST['category_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];

    
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['attachment']['name']);
        $filePath = $uploadDir . $fileName;

       
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $filePath)) {
            $attachment = $filePath;
        } else {
            $attachment = null;
        }
    } else {
        $attachment = null;
    }

    try {
     
        $db = new db();
        $conn = $db->connect();

        // Insert the data into master_item table
        $sql = "INSERT INTO master_item (brand_id, category_id, code, name, attachment)
                VALUES (:brand_id, :category_id, :code, :name, :attachment)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':attachment', $attachment);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Item created successfully!";
        } else {
            echo "Error creating item.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
