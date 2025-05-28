<?php
require_once("../connection.php");

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
    $profilepic_url = isset($_POST['profilepic_url']) ? $_POST['profilepic_url'] : null;

    // Optional: profilepic_url nur setzen, wenn übergeben
    if ($profilepic_url !== null && $profilepic_url !== "") {
        $stmt = $con->prepare("UPDATE users SET username =?, email=?, firstName=?, lastName=?, profilepic_url=? WHERE username=?");
        $stmt->bind_param("sssss", $username, $email, $firstName, $lastName, $profilepic_url, $username);
    } else {
        $stmt = $con->prepare("UPDATE users SET username =?, email=?, firstName=?, lastName=? WHERE username=?");
        $stmt->bind_param("ssss", $username, $email, $firstName, $lastName, $username);
    }

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