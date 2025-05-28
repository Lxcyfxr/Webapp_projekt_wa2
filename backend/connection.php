<!-- Datenbank eintrag -->
<?php


$config = parse_ini_file('../config.ini', true);
$db = $config['database'];
$servername = $db['host'];
$username = $db['user'];
$password = $db['password'];
$dbname = $db['dbname'];

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die('Datenbankverbindung fehlgeschlagen: ' . $con->connect_error);
}
?>