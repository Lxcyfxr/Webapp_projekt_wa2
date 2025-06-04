<?php
require_once("../backend/connection.php");

if (
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['vorname']) &&
    isset($_POST['nachname'])
) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['vorname'];
    $lastName = $_POST['nachname'];
    $address = $_POST['address']; 
    // Optional: profilepic_url nur setzen, wenn übergeben
    
    $stmt = $con->prepare("UPDATE users SET email=?, firstName=?, lastName=?, `address`=? WHERE username=?");
    $stmt->bind_param("sssss", $email, $firstName, $lastName, $address, $username);
    

    if ($stmt->execute()) {
        header("Location: profile.php?message=Daten erfolgreich geändert!");
        exit();
    } else {
        echo "Fehler beim Ändern der Userdaten.";
    }

    $stmt->close();
} else {
    echo "Bitte alle Daten angeben.";
}
?>