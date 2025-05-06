<?php


require_once 'classes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $conn = (new db())->connect();

        $conn->beginTransaction();

        // Delete the record
        echo "Deleting record with ID: " . $id;  // Debug statement

        $stmt = $conn->prepare("DELETE FROM master_brand WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        echo "Deleted";
    } catch (PDOException $e) {
        // Rollback transaction on error
        $conn->rollBack();
        http_response_code(500);
        echo "Error: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>
