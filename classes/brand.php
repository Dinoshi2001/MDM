<?php
require_once 'classes/db.php';

class brand {
    private $conn;
    private $table = 'master_brand';

    public function __construct() {
        $database = new db();
        $this->conn = $database->connect();
    }

    public function create($code, $name, $status) {
        try {
            $sql = "INSERT INTO master_brand (code, name, status) VALUES (:code, :name, :status)";
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



public function getAllBrands() {
    try {
        $sql = "SELECT * FROM master_brand";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}


public function getBrandById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM brands WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update brand details
    public function updateBrand($id, $code, $name, $status)
    {
        $stmt = $this->db->prepare("UPDATE brands SET code = :code, name = :name, status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function getActiveBrands() {
        $query = "SELECT id, name FROM {$this->table} WHERE status = 'Active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}



?>
