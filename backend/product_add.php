<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die('Zugriff verweigert');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
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

    // Bild-Upload
    $image_url = null;
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../products/';
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = 'product' . $next_id . '.' . $ext;
        $image_path = $upload_dir . $image_name;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $image_path)) {
            $image_url = '/../products/' . $image_name;
        } else {
            die('Fehler beim Hochladen des Bildes.');
        }
    } else {
        die('Kein Bild ausgewählt oder Fehler beim Upload.');
    }

    $stmt = $conn->prepare('INSERT INTO testproducts (id, name, description, picture, price, gender, size, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('isssdsss', $next_id, $product_name, $description, $image_url, $price, $gender, $size, $brand);

    if ($stmt->execute()) {
        header('Location: ../public/profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich hinzugefügt!'));
        exit();
    } else {
        header('Location: ..public/profile.php?message=' . urlencode('Fehler beim Hinzufügen von ' . $product_name . '!'));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>