<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit;
}

// Nur ausführen, wenn das Formular abgeschickt wurde (per POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['id'];

    $config = parse_ini_file('../config.ini', true);
    $db = $config['database'];
    $servername = $db['host'];
    $username = $db['user'];
    $password = $db['password'];
    $dbname = $db['dbname'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Warenkorb prüfen
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        header("Location: /public/cart.php?message=Ihr Warenkorb ist leer!");
        exit;
    }

    // Beispiel: Preis berechnen (hier als Summe aller Preise im Warenkorb)
    $cart_items = $result->fetch_all(MYSQLI_ASSOC);
    $total_price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;

    // Bestellung eintragen
    $stmt = $conn->prepare("INSERT INTO buy_history (user_id, date, price) VALUES (?, NOW(), ?)");
    $stmt->bind_param("id", $userid, $total_price);
    $stmt->execute();

    // Optional: Warenkorb leeren
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();

        header("Location: /public/cart.php?message=Danke für Ihren Einkauf! Ihre Bestellung wurde erfolgreich aufgegeben.");
    exit;
    }
?>
