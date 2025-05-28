<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
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

    // Hole existierende Produktdaten
    $stmt = $conn->prepare('SELECT name, description, picture, price, gender, size, brand FROM testproducts WHERE id = ?');
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_data = $result->fetch_assoc();
    $stmt->close();

    // Verwende neue Werte nur wenn sie nicht leer sind
    $product_name = !empty($_POST['product_name']) ? $_POST['product_name'] : $existing_data['name'];
    $description = !empty($_POST['description']) ? $_POST['description'] : $existing_data['description'];
    $price = !empty($_POST['price']) ? $_POST['price'] : $existing_data['price'];
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : $existing_data['gender'];
    $brand = !empty($_POST['brand']) ? $_POST['brand'] : $existing_data['brand'];
    $size = !empty($_POST['sizes']) ? json_encode($_POST['sizes']) : $existing_data['size'];
    $image_url = $existing_data['picture']; // Standard: behalte existierendes Bild

    // Update Bild nur wenn eines hochgeladen wurde
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../products/';
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = 'product' . $product_id . '.' . $ext;
        $image_path = $upload_dir . $image_name;
        
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $image_path)) {
            $image_url = '/../products/' . $image_name;
            
            // Optional: Lösche altes Bild wenn es existiert
            if ($existing_data['picture'] && file_exists(__DIR__ . '/' . $existing_data['picture'])) {
                unlink(__DIR__ . '/' . $existing_data['picture']);
            }
        } else {
            die('Fehler beim Hochladen des Bildes.');
        }
    }

    // Update Query mit dem korrekten Bildpfad
    $stmt = $conn->prepare('UPDATE testproducts SET name = ?, description = ?, picture = ?, price = ?, gender = ?, size = ?, brand = ? WHERE id = ?');
    $stmt->bind_param('sssssssi', $product_name, $description, $image_url, $price, $gender, $size, $brand, $product_id);

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