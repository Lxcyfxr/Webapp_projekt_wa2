<?php
session_start();
if ($_SESSION['username'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price'];
    $gender = $_POST['gender'] ?? null;
    $size = $_POST['size'] ?? null;
    $brand = $_POST['brand'] ?? null;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    $result = $conn->query('SELECT MIN(t1.id + 1) AS next_id FROM testproducts t1 LEFT JOIN testproducts t2 ON t1.id + 1 = t2.id WHERE t2.id IS NULL');
    $row = $result->fetch_assoc();
    $next_id = $row['next_id'] ?? 1;

    $stmt = $conn->prepare('INSERT INTO testproducts (id, name, description, picture, price, gender, size, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('isssdsss', $next_id, $product_name, $description, $image_url, $price, $gender, $size, $brand);

    if ($stmt->execute()) {
        header('Location: profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich hinzugefügt!'));
        exit();
    } else {
        echo 'Fehler beim Hinzufügen des Produkts: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>