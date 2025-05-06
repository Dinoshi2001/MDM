<?php
require_once 'classes/db.php';

class Category {
    private $conn;
     private $table = 'master_category';

    public function __construct() {
        $database = new db();
        $this->conn = $database->connect();
    }

    public function create($code, $name, $status) {
        try {
            // Check for duplicate code
            $checkSql = "SELECT COUNT(*) FROM master_category WHERE code = :code";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':code', $code);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                return "duplicate"; 
            }

            // Insert new category
            $sql = "INSERT INTO master_category (code, name, status) VALUES (:code, :name, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
    public function getAllCategories() {
        try {
            $sql = "SELECT * FROM master_category";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
/*
    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM master_category WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

   /* public function updateCategory($id, $code, $name, $status) {
        $stmt = $this->conn->prepare("UPDATE master_category SET code = :code, name = :name, status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }*/

    public function getActiveCategories() {
        $query = "SELECT id, name FROM {$this->table} WHERE status = 'Active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $code, $name, $status) {
    $sql = "UPDATE master_category SET code = :code, name = :name, status = :status WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':code' => $code,
        ':name' => $name,
        ':status' => $status,
        ':id' => $id
    ]);
}


    public function getCategoryById($id) {
        $sql = "SELECT * FROM master_category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>

