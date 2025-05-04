<!-- filepath: c:\xampp\htdocs\DHBW\Stylung\public\delete_product.php -->
<?php
session_start();
if ($_SESSION['username'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare('DELETE FROM testproducts WHERE id = ?');
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        header('Location: profile.php?message=Produkt erfolgreich gelöscht!');
        exit();
    } else {
        echo 'Fehler beim Entfernen des Produkts: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>