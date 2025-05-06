<?php
require_once 'classes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $conn = (new db())->connect();

        $conn->beginTransaction();

        // Delete the category
        $stmt = $conn->prepare("DELETE FROM master_category WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Re-sequence the IDs
        $conn->exec("SET @count = 0; UPDATE master_category SET id = @count := (@count + 1)");

        // Commit the transaction
        $conn->commit();

        echo "Deleted";
    } catch (PDOException $e) {
        $conn->rollBack();
        http_response_code(500);
        echo "Error: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>
