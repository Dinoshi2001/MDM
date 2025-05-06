<?php
require_once 'db.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

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

    $database = new db();
    $fetcher = new ItemFetcher($database);
    $item = $fetcher->getItemById($id);

    header('Content-Type: application/json');
    echo json_encode($item);
    exit;
}
?>
