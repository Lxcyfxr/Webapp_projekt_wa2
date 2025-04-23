<?php
require("connection.php");
session_start();

// Session Timeout Handling
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
    session_unset();
    session_destroy();
    header("Location: test.php");
    exit();
}
$_SESSION['last_activity'] = time();

// Logout Handling
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: test.php");
    exit();
}

// Login Handling
$loginError = "";
if (isset($_POST["username"], $_POST["password"]) && !isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userExists = $result->fetch_assoc();

    if ($userExists) {
        $passwordHashed = $userExists["password"];
        if (password_verify($password, $passwordHashed)) {
            $_SESSION["username"] = $userExists["username"];
            $_SESSION['last_activity'] = time();
            header("Location: index.php");
            exit();
        } else {
            $loginError = "⚠️ Falsches Passwort.";
        }
    } else {
        $loginError = "⚠️ Benutzer nicht gefunden.";
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
    <title>Login / Register</title>
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Login Form -->
            <form action="test.php" class="sign-in-form" method="POST">
                <h2 class="title">Sign in</h2>
                <?php if (!empty($loginError)): ?>
                    <p style="color:red; font-weight:bold;"><?php echo $loginError; ?></p>
                <?php endif; ?>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="username" id="username" type="text" placeholder="Enter your Username" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password" id="password" type="password" placeholder="Enter the Password" required />
                </div>
                <input type="submit" value="Login" class="btn solid"/>
            </form>

            <!-- Register Form -->
            <form action="test.php" class="sign-up-form" method="POST">
                <h2 class="title">Sign up</h2>
                <div class="input-field"><i class="fas fa-user"></i>
                    <input name="firstName" type="text" placeholder="First Name" required />
                </div>
                <div class="input-field"><i class="fas fa-user"></i>
                    <input name="lastName" type="text" placeholder="Last Name" required />
                </div>
                <div class="input-field"><i class="fas fa-user"></i>
                    <input name="username" type="text" placeholder="User Name" required />
                </div>
                <div class="input-field"><i class="fas fa-envelope"></i>
                    <input name="email" type="email" placeholder="Email" required />
                </div>
                <div class="input-field"><i class="fas fa-lock"></i>
                    <input name="password" type="password" placeholder="Password" required />
                </div>
                <div class="password-strength">
                    <div id="strength-bar"></div>
                    <span id="strength-text"></span>
                </div>
                <div class="input-field"><i class="fas fa-user"></i>
                    <input name="address" type="text" placeholder="Address" />
                </div>
                <input type="submit" class="btn" value="Sign up"/>
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <p>Please create a new account</p>
                <button class="btn transparent" id="sign-up-btn">Sign up</button>
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
