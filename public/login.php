<?php
    require("connection.php");

    if(isset($_POST["submit"])){

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
                session_start();
                $_SESSION["username"] = $userExists["username"];
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
    <?php include 'navbar.html'; ?>
    <form action="login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login" name="submit">
    </form>
</body>
</html>