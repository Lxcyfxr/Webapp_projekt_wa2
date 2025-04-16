<?php
    require("connection.php");
    session_start();

    // Check for session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) { // 900 seconds = 15 minutes
        // Session expired
        session_unset(); // Unset session variables
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to login page
        exit();
    }
    $_SESSION['last_activity'] = time(); // Update last activity timestamp

    // Handle manual logout
    if (isset($_POST['logout'])) {
        session_unset(); // Unset session variables
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to login page
        exit();
    }

    if (isset($_POST["submit"])) {

        $username = $_POST["username"];
        $password = $_POST["password"]; // Do not hash the password here; it's hashed in the database.

        // Prepare the SQL statement using MySQLi
        $stmt = $con->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $username); // Bind username for both username and email checks
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $userExists = $result->fetch_assoc();

        if ($userExists) {
            $passwordHashed = $userExists["password"];
            $checkPassword = password_verify($password, $passwordHashed);

            if ($checkPassword == false) {
                echo "Password ist falsch";
            } else if ($checkPassword == true) {
                // Correct password
                $_SESSION["username"] = $userExists["username"];
                $_SESSION['last_activity'] = time(); // Set last activity timestamp
                header("Location: index.php");
                exit();
            }
        } else {
            echo "Benutzer nicht gefunden";
        }

        $stmt->close();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body style="background: #333; color: white;padding-top:3%">
    <?php include 'navbar.php'; ?>
    <form action="login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login" name="submit">
    </form>

    <!-- Logout Button -->
    <?php if (isset($_SESSION["username"])): ?>
        <form action="login.php" method="POST" style="margin-top: 20px;">
            <input type="submit" value="Logout" name="logout" style="background-color: red; color: white; padding: 10px; border: none; cursor: pointer;">
        </form>
    <?php endif; ?>
</body>
</html>