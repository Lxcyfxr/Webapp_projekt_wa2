<!--Last Change:    -->
<!--Reason:         -->
<?php
    require("connection.php");
    session_start();

    // Check for session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    $_SESSION['last_activity'] = time();

    // Handle manual logout
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Prepare the SQL statement using MySQLi
        $stmt = $con->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $userExists = $result->fetch_assoc();

        if ($userExists) {
            $passwordHashed = $userExists["password"];
            $checkPassword = password_verify($password, $passwordHashed);

            if ($checkPassword == false) {
                echo "Password is incorrect";
            } else if ($checkPassword == true) {
                $_SESSION["username"] = $userExists["username"];
                $_SESSION['last_activity'] = time();
                header("Location: index.php");
                exit();
            }
        } else {
            echo "User not found";
        }

        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/authentication.css">
    <title>Sign in & Sign up Form</title>
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Login Form -->
            <form action="login.php" class="sign-in-form" method="POST">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="username" id="username" type="text" placeholder="Enter your Username" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password" id="password" type="password" placeholder="Enter the Password" required />
                </div>
                <input type="submit" value="Login" class="btn solid" name="submit"/>
            </form>
        </div>
    </div>

    <!-- Panels -->
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <p>Please create a new account</p>
                <button class="btn transparent" onclick="window.location.href='register.php'">Sign up</button>
            </div>
            <img src="pictures/LoginFeld.png" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>Are you already one of us?</h3>
                <p>Please log in</p>
                <button class="btn transparent" id="sign-in-btn">Sign in</button>
            </div>
            <img src="pictures/SignInFeld.png" class="image" alt=""/>
        </div>
    </div>
</div>

<!-- JS für UI-Wechsel -->
<script src="/app.js"></script>
</body>
</html>