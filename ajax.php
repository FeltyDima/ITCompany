<?php
require_once 'script.php';
header('Content-Type: application/json');

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $contacts = $database->getContacts();
    echo json_encode($contacts);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (empty($name) || empty($email) || empty($phone)) {
        http_response_code(400);
        echo json_encode(['error' => 'Заполните все поля']);
        exit;
    }

    $result = $database->saveContact($name, $email, $phone);
    echo json_encode(['success' => $result]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не поддерживается']);
}
?>