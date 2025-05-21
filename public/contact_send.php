<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webapp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Verbindung fehlgeschlagen"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $problem = $_POST['problem'] ?? '';

    $stmt = $conn->prepare("INSERT INTO info_contacts (email, problem) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $problem);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Fehler beim Absenden"]);
    }

    $stmt->close();
}

$conn->close();

