<?php
$config = parse_ini_file('../config.ini', true);
$db = $config['database'];
$servername = $db['host'];
$username = $db['user'];
$password = $db['password'];
$dbname = $db['dbname'];
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die('Datenbankverbindung fehlgeschlagen: ' . $con->connect_error);
}
header('Content-Type: application/json');

$ids = [2, 1, 3];
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

$stmt = $con->prepare("SELECT id, picture FROM testproducts WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$ids);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
echo json_encode($products);
?>