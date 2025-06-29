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

    $config = parse_ini_file('../config.ini', true);
    $db = $config['database'];
    $servername = $db['host'];
    $username = $db['user'];
    $password = $db['password'];
    $dbname = $db['dbname'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(['error' => 'Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error]);
        exit;
    }

    // Prüfen, ob der Eintrag bereits existiert
    $checkSql = "SELECT amount FROM cart WHERE product_id = ? AND user_id = ? AND size = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('iis', $product_id, $user_id, $size);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Eintrag existiert, Menge erhöhen
        $updateSql = "UPDATE cart SET amount = amount + 1 WHERE product_id = ? AND user_id = ? AND size = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('iis', $product_id, $user_id, $size);
        if ($updateStmt->execute()) {
            echo json_encode(['success' => 'Product amount increased']);
        } else {
            echo json_encode(['error' => 'Failed to update product amount']);
        }
        $updateStmt->close();
    } else {
        // Neuer Eintrag
        $sql = "INSERT INTO cart (product_id, amount, user_id, size) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiis', $product_id, $amount, $user_id, $size);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Product added to cart']);
        } else {
            echo json_encode(['error' => 'Failed to add product to cart']);
        }
        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>