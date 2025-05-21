<?php
// Datenbankverbindung herstellen
$servername = "localhost"; // oder IP-Adresse deines MySQL-Servers
$username = "root"; // Dein MySQL-Benutzername
$password = ""; // Dein MySQL-Passwort
$dbname = "webapp_project"; // Name der Datenbank, die du verwendest

// Verbindung aufbauen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich ist
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Benutzereingaben holen
    $email = $_POST['email'];
    $problem = $_POST['problem'];

    // SQL-Query vorbereiten, um die Daten in die Tabelle 'info_contacts' zu speichern
    $stmt = $conn->prepare("INSERT INTO info_contacts (email, problem) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $problem); // "ss" bedeutet, dass beide Parameter Strings sind

    // SQL-Query ausführen
    if ($stmt->execute()) {
        echo "Danke für Ihre Nachricht, das Stylungs Team meldet sich möglichst schnell bei Ihnen!";
    } else {
        echo "Fehler beim Absenden der Nachricht: " . $stmt->error;
    }

    // Prepared Statement und Verbindung schließen
    $stmt->close();
}

$conn->close();
?>
