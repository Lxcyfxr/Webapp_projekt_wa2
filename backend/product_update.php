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
    $size = $_POST['sizes'] ?? ['XS', 'S', 'M', 'L', 'XL'];
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
        $stmt = $conn->prepare('SELECT name FROM  testproducts WHERE id = ?');
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $stmt->bind_result($product_name);
        $stmt->fetch();
        $stmt->close();

        if (empty($product_name)) {
            header('Location: profile.php?message=' . urlencode('Fehler beim Aktualisieren vom Produkt mit der ID ' . $product_id . '!'));
            exit();
        }
    }

    $image_url = null;
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '../products/';
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = 'product' . $next_id . '.' . $ext;
        $image_path = $upload_dir . $image_name;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $image_path)) {
            $image_url = '../products/' . $image_name;
        } else {
            die('Fehler beim Hochladen des Bildes.');
        }
    } 

    $sizesJson = json_encode($size);

    $stmt = $conn->prepare('UPDATE testproducts SET name = ?, description = ?, picture = ?, price = ?, gender = ?, size = ?, brand = ? WHERE id = ?');
    $stmt->bind_param('sssssssi', $product_name, $description, $image_url, $price, $gender, $size, $brand, $product_id);

    if ($stmt->execute()) {
        header('Location: profile.php?message=' . urlencode('Produkt ' . $product_name . ' erfolgreich aktualisiert!'));
        exit();
    } else {
        header('Location: profile.php?message=' . urlencode('Fehler beim Aktualisieren vom Produkt mit der ID ' . $product_id . '!'));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>