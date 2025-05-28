<?php
require_once("../backend/connection.php");

if (!isset($_SESSION['username'])) {
    echo "Nicht eingeloggt.";
    exit();
}

// User-ID ermitteln
$username = $_SESSION['username'];
$stmt1 = $con->prepare("SELECT id FROM users WHERE username= ?");
$stmt1->bind_param("s", $username);
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows == 0) {
    echo "Benutzer nicht gefunden.";
    exit();
}
$user_row = $result1->fetch_assoc();
$user_id = $user_row['id'];
$stmt1->close();

// Bestellungen laden
$stmt = $con->prepare("SELECT * FROM buy_history WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<h2 class="outfit-300" style="text-align:center; width:100%;">Bestellverlauf</h2>';
if ($result->num_rows > 0) {
    echo '<table class="outfit-300" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="padding:8px; border-bottom:1px solid #444; text-align:center;">Bestellnummer</th>
                    <th style="padding:8px; border-bottom:1px solid #444; text-align:center;">Datum</th>
                    <th style="padding:8px; border-bottom:1px solid #444; text-align:center;">Preis</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td style="padding:8px; border-bottom:1px solid #222; text-align:center;">' . htmlspecialchars($row['order_id']) . '</td>
                <td style="padding:8px; border-bottom:1px solid #222; text-align:center;">' . htmlspecialchars($row['date']) . '</td>
                <td style="padding:8px; border-bottom:1px solid #222; text-align:center;">' . htmlspecialchars($row['price']) . ' €</td>
              </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="outfit-300" style="margin-top:1rem;">Keine Bestellungen gefunden.</div>';
}

$stmt->close();
?>