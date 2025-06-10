<?php
// ...existing code...

// Username validieren (keine Sonderzeichen)
if (!preg_match('/^[a-zA-Z0-9._-]+$/', $username)) {
    $errors[] = "Der Benutzername enthält ungültige Zeichen.";
}

// E-Mail validieren (Standardfilter)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Ungültige E-Mail-Adresse.";
}

// Passwort: keine Einschränkung auf Sonderzeichen, nur ggf. Mindestlänge prüfen
if (strlen($password) < 8) {
    $errors[] = "Das Passwort muss mindestens 8 Zeichen lang sein.";
}

// ...existing code...