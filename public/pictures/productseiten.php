<?php
$conn = new mysqli("localhost", "root", "", "webapp_project");
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM testproducts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $produkt = $result->fetch_assoc();

    if ($produkt) {
        echo "<h1>" . htmlspecialchars($produkt['name']) . "</h1>";
        echo "<p>" . nl2br(htmlspecialchars($produkt['beschreibung'])) . "</p>";
        echo "<p>Preis: " . number_format($produkt['preis'], 2) . " €</p>";
    } else {
        echo "Produkt nicht gefunden.";
    }
} else {
    echo "Keine Produkt-ID angegeben.";
}
$stmt->close();
$conn->close();
?>