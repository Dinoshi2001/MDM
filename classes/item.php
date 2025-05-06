<?php

include_once 'classes/db.php';

class item {
    private $conn;

   
    public function __construct() {
        $db = new db();
        $this->conn = $db->connect();
    }

   
    public function insertItem($brand_id, $category_id, $code, $name, $attachment, $status) {
        try {
            
            $stmt = $this->conn->prepare("INSERT INTO master_item (brand_id, category_id, code, name, attachment, status) 
                                          VALUES (?, ?, ?, ?, ?, ?)");
            
           
            $stmt->bindParam(1, $brand_id);
            $stmt->bindParam(2, $category_id);
            $stmt->bindParam(3, $code);
            $stmt->bindParam(4, $name);
            $stmt->bindParam(5, $attachment);  
            $stmt->bindParam(6, $status);

           
            $stmt->execute();

            return true;  
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; 
        }
    }


public function getAllItems() {
    try {
        $query = "SELECT mi.id, mb.name AS brand, mc.name AS category, mi.code, mi.name, mi.attachment, mi.status
                  FROM master_item mi
                  JOIN master_brand mb ON mi.brand_id = mb.id
                  JOIN master_category mc ON mi.category_id = mc.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

public function deleteItem($id) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM master_item WHERE id = ?");
        $stmt->bindParam(1, $id);
        return $stmt->execute(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
/*

public function getItemById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM master_item WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return one item
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
*/


public function getItemById($id) {
    try {
        $stmt = $this->conn->prepare("
            SELECT 
                i.*, 
                b.name AS brand_name, 
                c.name AS category_name
            FROM 
                master_item i
            LEFT JOIN master_brand b ON i.brand_id = b.id
            LEFT JOIN master_category c ON i.category_id = c.id
            WHERE 
                i.id = ?
        ");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
public function update($id, $brand_id, $category_id, $code, $name, $status) {
    try {
        // Handle file upload
        $attachment = null;
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            // Move the uploaded file to the desired location
            $attachmentPath = "uploads/" . basename($_FILES['attachment']['name']);
            move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentPath);
            $attachment = $attachmentPath; // Save the file path
        }

        // Build SQL query to update the item
        $sql = "UPDATE master_item SET 
                    brand_id = :brand_id,
                    category_id = :category_id,
                    code = :code,
                    name = :name,
                    status = :status" . 
                    ($attachment ? ", attachment = :attachment" : "") . 
                " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        // Bind attachment if file was uploaded
        if ($attachment) {
            $stmt->bindParam(':attachment', $attachment);
        }

        // Check if the query is executed successfully
        if ($stmt->execute()) {
            return true;
        } else {
            // If execute failed, fetch and log the error details
            $errorInfo = $stmt->errorInfo();
            error_log("Update failed: " . implode(", ", $errorInfo));
            return false;
        }
    } catch (PDOException $e) {
        // Log any exceptions to help debug
        error_log("Update failed: " . $e->getMessage());
        return false;
    }
}
}
?>

