<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Stylung</title>
    <link
      rel="icon"
      href="/public/pictures/Logo_Stylung.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./css/cart.css" />
    <script src=./jquery-3.7.1.min.js></script>
  </head>
  <body style="padding-top: 2rem">
    <?php 
    session_start();
    require_once("../connection.php");
    include 'navbar.php'; 
    ?>
    <h1>
      Warenkorb von
      <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);} 
            else{echo "Gast";}    
        ?>
    </h1>
    
    <?php
        $userid = intval($_SESSION['userid']);
        $stmt = $con->prepare("SELECT c.*, p.product_name, p.price, p.image_url FROM cart c JOIN products p ON c.productid = p.id WHERE c.userid = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h1>Dein Warenkorb</h1>";
        echo "<table>";
        echo "<tr><th>Bild</th><th>Name</th><th>Menge</th><th>Größe</th><th>Preis</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td><img src='".htmlspecialchars($row['image_url'])."' width='50'></td>
                <td>".htmlspecialchars($row['product_name'])."</td>
                <td>".intval($row['amount'])."</td>
                <td>".htmlspecialchars($row['size'])."</td>
                <td>".number_format($row['price'], 2)." €</td>
            </tr>";
        }
        echo "</table>";
        $stmt->close();
        ?>
  </body>
</html>
