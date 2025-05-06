<?php
session_start();
if ($_SESSION['username'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price']; 
    $gender = $_POST['gender'];
    $size = $_POST['size'];
    $brand = $_POST['brand'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    if (empty($product_name)) {
        $stmt = $conn->prepare('SELECT name FROM testproducts WHERE id = ?');
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $stmt->bind_result($product_name);
        $stmt->fetch();
        $stmt->close();

        if (empty($product_name)) {
            die('Produkt nicht gefunden.');
        }
    }

    $stmt = $conn->prepare('UPDATE testproducts SET name = ?, description = ?, picture = ?, price = ?, gender = ?, size = ?, brand = ? WHERE id = ?');
    $stmt->bind_param('sssssssi', $product_name, $description, $image_url, $price, $gender, $size, $brand, $product_id);

    if ($stmt->execute()) {
        header('Location: profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich aktualisiert!'));
        exit();
    } else {
        echo 'Fehler beim Bearbeiten des Produkts: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>