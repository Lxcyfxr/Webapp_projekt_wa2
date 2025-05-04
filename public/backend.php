<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webapp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//SQL query
$sql = "SELECT * FROM testproducts";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>