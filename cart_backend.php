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
    die(json_encode(['error' => 'User not logged in']));
}
$username = $_SESSION['username'];
// fetched die userId mit dem username
$sql_user = "SELECT id FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('s', $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows === 0) {
    die(json_encode(['error' => 'User not found']));
}

$user = $result_user->fetch_assoc();
$user_id = $user['id'];
// mit userId werden die Produkte aus der Carttabelle gefetched
$sql = "SELECT product.name, 
            product.description, 
            product.price, 
            product.picture, 
            cart.amount, 
            cart.size 
        FROM cart
        JOIN testproducts product ON cart.product_id = product.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);

$stmt_user->close();
$stmt->close();
$conn->close();
?>