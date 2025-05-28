<?php
require_once("../connection.php");
header('Content-Type: application/json');

// IDs der gewünschten Produkte (z.B. 1, 2, 3)
$ids = [1, 2, 3];
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

$stmt = $con->prepare("SELECT id, name, description, picture FROM testproducts WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$ids);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
echo json_encode($products);
?>