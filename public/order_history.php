<?php
require_once("../connection.php");

if (!isset($_SESSION['username'])) {
    echo "Nicht eingeloggt.";
    exit();
}

$user_id = $_SESSION['id'];


// Beispiel: Tabelle "orders" mit Spalten: id, user_id, product_name, order_date, price
$stmt = $con->prepare("SELECT * FROM buy_history WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<h2 class="outfit-300">Warenverlauf</h2>';
if ($result->num_rows > 0) {
    echo '<table class="outfit-300"><tr><th>Produkt</th><th>Datum</th><th>Preis</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['order_id']) . '</td>
                <td>' . htmlspecialchars($row['date']) . '</td>
                <td>' . htmlspecialchars($row['price']) . ' €</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo 'Keine Bestellungen gefunden.';
}

$stmt->close();
?>