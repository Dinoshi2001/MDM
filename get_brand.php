<?php
require_once 'classes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new db();
    $conn = $database->connect();

    $stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
    $stmt->execute([$id]);
    $brand = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($brand);
}
?>
