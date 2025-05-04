<!-- filepath: c:\xampp\htdocs\DHBW\Stylung\public\add_product.php -->
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
    $gender = $_POST['gender'] ?? null; // MALE, FEMALE, NULL
    $size = $_POST['size'] ?? null; // Standard NULL
    $brand = $_POST['brand'] ?? null; // Standard NULL

    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Kleinste freie ID ermitteln
    $result = $conn->query('SELECT MIN(t1.id + 1) AS next_id FROM testproducts t1 LEFT JOIN testproducts t2 ON t1.id + 1 = t2.id WHERE t2.id IS NULL');
    $row = $result->fetch_assoc();
    $next_id = $row['next_id'] ?? 1; // Falls keine Produkte existieren, mit ID 1 starten

    // Produkt mit der ermittelten ID hinzufügen
    $stmt = $conn->prepare('INSERT INTO testproducts (id, name, description, picture, price, gender, size, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('isssdsss', $next_id, $product_name, $description, $image_url, $price, $gender, $size, $brand);

    if ($stmt->execute()) {
        header('Location: profile.php?message=Produkt erfolgreich hinzugefügt!');
        exit();
    } else {
        echo 'Fehler beim Hinzufügen des Produkts: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>