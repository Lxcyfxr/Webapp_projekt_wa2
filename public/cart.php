<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <title>Stylung – Warenkorb</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/cart.css" />
</head>
<body>
<?php
session_start();
require_once("../connection.php");
include 'navbar.php';

if (!isset($_SESSION['username'])) {
    echo "<div class='cart-container'><p>Bitte <a href='auth.php' style='color:#2cc9c2'>loggen</a> Sie sich ein, um Ihren Warenkorb zu sehen.</p></div>";
    exit;
}
$userid = $_SESSION['id'];

// Menge erhöhen/verringern/löschen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['product_id'], $_POST['size'])) {
        $product_id = intval($_POST['product_id']);
        $size = $_POST['size'];
        if ($_POST['action'] === 'increase') {
            $stmt = $con->prepare("UPDATE cart SET amount = amount + 1 WHERE user_id = ? AND product_id = ? AND size = ?");
            $stmt->bind_param("iis", $userid, $product_id, $size);
            $stmt->execute();
            $stmt->close();
        } elseif ($_POST['action'] === 'decrease') {
            $stmt = $con->prepare("UPDATE cart SET amount = amount - 1 WHERE user_id = ? AND product_id = ? AND size = ? AND amount > 1");
            $stmt->bind_param("iis", $userid, $product_id, $size);
            $stmt->execute();
            $stmt->close();
        } elseif ($_POST['action'] === 'delete') {
            $stmt = $con->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
            $stmt->bind_param("iis", $userid, $product_id, $size);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: cart.php");
        exit;
    }
}

// Cart anzeigen
$stmt = $con->prepare("
    SELECT 
        c.amount, 
        c.size, 
        c.product_id, 
        p.name, 
        p.picture, 
        p.description, 
        p.price
    FROM cart c
    JOIN testproducts p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

// Gesamtsumme berechnen
$total = 0.0;
$cartRows = [];
while ($row = $result->fetch_assoc()) {
    $cartRows[] = $row;
    $total += $row['amount'] * $row['price'];
}

// Adresse des Users holen
$stmt_addr = $con->prepare("SELECT address FROM users WHERE id = ?");
$stmt_addr->bind_param("i", $userid);
$stmt_addr->execute();
$stmt_addr->bind_result($address);
$stmt_addr->fetch();
$stmt_addr->close();

echo "<div class='cart-flex-container' style='display:flex; gap:2rem; justify-content:center; align-items:flex-start; width:100%; max-width:1100px; margin:2rem auto 0 auto;'>";

// Cart-Tabelle (links)
echo "<div class='cart-container'>";
echo "<div class='cart-title'>Warenkorb von " . htmlspecialchars($_SESSION['username']) . "</div>";

if (count($cartRows) === 0) {
    echo "<div class='cart-empty'>Dein Warenkorb ist leer. Schau doch mal <a href='shopsite.php' style='color:#2cc9c2'>hier</a> vorbei.</div>";
} else {
    echo "<table class='cart-table'>";
    foreach ($cartRows as $row) {
        echo "<tr class='cart-item'>
            <td><img src='" . htmlspecialchars($row['picture']) . "' alt='" . htmlspecialchars($row['name']) . "'></td>
            <td>
                <div style='font-weight:600;'>" . htmlspecialchars($row['name']) . "</div>
            </td>
            <td>
                <form method='POST' class='amount-form' style='display:inline;'>
                    <input type='hidden' name='product_id' value='" . intval($row['product_id']) . "'>
                    <input type='hidden' name='size' value='" . htmlspecialchars($row['size']) . "'>
                    <button type='submit' name='action' value='decrease' class='cart-btn'>-</button>
                </form>
                <span style='margin:0 0.5rem; font-weight:500;'>" . intval($row['amount']) . "</span>
                <form method='POST' class='amount-form' style='display:inline;'>
                    <input type='hidden' name='product_id' value='" . intval($row['product_id']) . "'>
                    <input type='hidden' name='size' value='" . htmlspecialchars($row['size']) . "'>
                    <button type='submit' name='action' value='increase' class='cart-btn'>+</button>
                </form>
            </td>
            <td>" . htmlspecialchars($row['size']) . "</td>
            <td>" . number_format($row['price'], 2) . " €</td>
            <td>
                <form method='POST' class='delete-form' style='display:inline;'>
                    <input type='hidden' name='product_id' value='" . intval($row['product_id']) . "'>
                    <input type='hidden' name='size' value='" . htmlspecialchars($row['size']) . "'>
                    <button type='submit' name='action' value='delete' class='cart-btn delete'>✕</button>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
}
echo "</div>";

// Checkout-Box (rechts)
$noAddress = empty($address);
echo "<div class='checkout-box'>";
echo "<div style='font-size:1.3rem; font-weight:600; margin-bottom:1.2rem;'>Checkout</div>";
echo "<div style='margin-bottom:1.2rem;'><span style='color:#bbb;'>Gesamtsumme:</span><br><span style='font-size:1.5rem; font-weight:700;'>" . number_format($total, 2) . " €</span></div>";
echo "<div style='margin-bottom:1.2rem;'><span style='color:#bbb;'>Lieferadresse:</span><br><span style='font-size:1.1rem;'>" . ($noAddress ? "Keine Adresse angegeben" : htmlspecialchars($address)) . "</span></div>";
echo "<button style='width:100%;padding:0.8rem 0;border:none;border-radius:8px;background:" . ($noAddress ? "#888" : "#c580f7") . ";color:#fff;font-size:1.1rem;font-weight:600;cursor:" . ($noAddress ? "not-allowed" : "pointer") . ";' " . ($noAddress ? "disabled" : "") . ">Jetzt bestellen</button>";
echo "</div>";

echo "</div>"; // Flex-Container

$stmt->close();
?>

<script>
// Seite nach +, - oder Löschen automatisch neu laden (ohne doppeltes Absenden)
document.querySelectorAll('.amount-form, .delete-form').forEach(form => {
    form.addEventListener('submit', function() {
        setTimeout(function() {
            window.location.reload();
        }, 100);
    });
});
</script>
