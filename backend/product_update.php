<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price']; 
    $gender = $_POST['gender'];
    $size = $_POST['sizes'];
    $brand = $_POST['brand'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webapp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
    }

    // Hole existierende Produktdaten
    $stmt = $conn->prepare('SELECT name, picture FROM testproducts WHERE id = ?');
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $stmt->bind_result($existing_name, $existing_picture);
    $stmt->fetch();
    $stmt->close();

    // Verwende existierende Werte wenn keine neuen angegeben
    $product_name = empty($product_name) ? $existing_name : $product_name;
    $image_url = $existing_picture; // Standard: behalte existierendes Bild

    // Update Bild nur wenn eines hochgeladen wurde
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '../products/';
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = 'product' . $product_id . '.' . $ext;
        $image_path = $upload_dir . $image_name;
        
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $image_path)) {
            $image_url = '../products/' . $image_name;
            
            // Optional: Lösche altes Bild wenn es existiert
            if ($existing_picture && file_exists(__DIR__ . '/' . $existing_picture)) {
                unlink(__DIR__ . '/' . $existing_picture);
            }
        } else {
            die('Fehler beim Hochladen des Bildes.');
        }
    }

    $sizesJson = json_encode($size);

    // Update Query mit dem korrekten Bildpfad
    $stmt = $conn->prepare('UPDATE testproducts SET name = ?, description = ?, picture = ?, price = ?, gender = ?, size = ?, brand = ? WHERE id = ?');
    $stmt->bind_param('sssssssi', $product_name, $description, $image_url, $price, $gender, $sizesJson, $brand, $product_id);

    if ($stmt->execute()) {
        header('Location: ../public/profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich aktualisiert!'));
        exit();
    } else {
        header('Location: ../public/profile.php?message=' . urlencode('Fehler beim Aktualisieren vom Produkt mit der ID ' . $product_id . '!'));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>