<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webapp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$username = $_SESSION['username'];
$sql_user = "SELECT id FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('s', $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows === 0) {
    echo json_encode(['error' => 'User not found']);
    exit();
}

$user = $result_user->fetch_assoc();
$user_id = $user['id'];

$product_id = $_POST['product_id'];
$size = $_POST['size'];
$amount = 1; 

$sql = "INSERT INTO cart (user_id, product_id, size, amount) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iisi', $user_id, $product_id, $size, $amount);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Product added to cart']);
} else {
    echo json_encode(['error' => 'Failed to add product to cart']);
}

$stmt->close();
$conn->close();
?>