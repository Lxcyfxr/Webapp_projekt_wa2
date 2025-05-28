<?php
session_start();
if ($_SESSION['username'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Produktname und Bildpfad holen
    $stmt = $conn->prepare('SELECT name, picture FROM testproducts WHERE id = ?');
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $stmt->bind_result($product_name, $picture_path);
    $stmt->fetch();
    $stmt->close();

    if (!$product_name) {
        die('Produkt nicht gefunden.');
    }

    // Bilddatei löschen, falls vorhanden
    if ($picture_path) {
        $file_path = realpath(__DIR__ . '/../products/' . basename($picture_path));
        // Sicherheit: Stelle sicher, dass das Bild im richtigen Ordner liegt
        $products_dir = realpath(__DIR__ . '/../products/');
        if ($file_path && strpos($file_path, $products_dir) === 0 && file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $stmt = $conn->prepare('DELETE FROM testproducts WHERE id = ?');
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        header('Location: profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich gelöscht!'));
        exit();
    } else {
        echo 'Fehler beim Entfernen des Produkts: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>