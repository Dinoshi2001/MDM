<?php
require_once 'db.php'; // Your DB connection file

$editCategory = null;

if (isset($_GET['edit_id'])) {
    class CategoryFetcher {
        private $conn;

        public function __construct($db) {
            $this->conn = $db->connect();
        }

        public function getCategoryById($id) {
            $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    $db = new db();
    $categoryFetcher = new CategoryFetcher($db);
    $editCategory = $categoryFetcher->getCategoryById($_GET['edit_id']);
}
?>
