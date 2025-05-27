<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['username'])) {
        echo json_encode(['error' => 'Nicht eingeloggt']);
        exit;
    }
    $user_id = $_SESSION['id'];
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $size = isset($_POST['size']) ? $_POST['size'] : '';
    $amount = 1;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(['error' => 'Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error]);
        exit;
    }

    $sql = "INSERT INTO cart (product_id, amount, user_id, size) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiis', $product_id, $amount, $user_id, $size);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Product added to cart']);
    } else {
        echo json_encode(['error' => 'Failed to add product to cart']);
    }

    $stmt->close();
    $conn->close();
}
?>