<?php
require_once 'db.php';

$editItem = null;

if (isset($_GET['edit_id'])) {
    class ItemFetcher {
        private $conn;

        public function __construct($db) {
            $this->conn = $db->connect();
        }

        public function getItemById($id) {
            $stmt = $this->conn->prepare("SELECT * FROM items WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    $db = new db();
    $itemFetcher = new ItemFetcher($db);
    $editItem = $itemFetcher->getItemById($_GET['edit_id']);
}
?>
