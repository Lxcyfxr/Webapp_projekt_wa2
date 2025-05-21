<?php
require_once("../connection.php");
if (isset($_POST['username']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
$stmt = $con->prepare("UPDATE users SET role=? WHERE username=?");
    $stmt->bind_param("ss", $role, $username);

    if ($stmt->execute()) {
        header("Location: profile.php?message=Rolle erfolgreich geändert!");
        exit();
    } else {
        echo "Fehler beim Ändern der Rolle.";
    }

    $stmt->close();
} else {
    echo "Bitte Benutzername und Rolle angeben.";
}


?>