<?php
session_start();
if ($_SESSION['username'] !== 'admin') {
    die('Zugriff verweigert');
}

$config = parse_ini_file('../config.ini', true);
$db = $config['database'];
$servername = $db['host'];
$username = $db['user'];
$password = $db['password'];
$dbname = $db['dbname'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error);
}

$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

$stmt = $conn->prepare("SELECT id, username, email, role FROM users WHERE username LIKE ? ORDER BY username ASC");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();

header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="users.json"');
echo json_encode($users, JSON_PRETTY_PRINT);
exit;
?>