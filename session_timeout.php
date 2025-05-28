<!DOCTYPE html>
<head>
    <script src="/public/js/session_timeout.js"></script>
</head>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
    session_unset();
    session_destroy();
    header("Location: auth.php");
    exit();
}

$_SESSION['last_activity'] = time();
?>