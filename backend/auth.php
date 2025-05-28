<?php
// ...existing code...

function hasInvalidChars($input, $allowAt = false) {
    if ($allowAt) {
        return preg_match('/[^a-zA-Z0-9@._-]/', $input);
    } else {
        return preg_match('/[^a-zA-Z0-9._-]/', $input);
    }
}

// Beispiel für Login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$authcode = $_POST['authcode'] ?? '';

if (hasInvalidChars($username) || hasInvalidChars($password) || hasInvalidChars($authcode)) {
    die("Fehler: Ungültige Zeichen in den Eingabefeldern.");
}

// ...existing code...