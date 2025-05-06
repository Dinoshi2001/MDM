<?php
include_once 'classes/db.php';
include_once 'classes/item.php';

$item = new item();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $itemId = $data['id'];
        $result = $item->deleteItem($itemId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
}
