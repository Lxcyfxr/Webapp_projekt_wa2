<?php
    require("connection.php");
    session_start();

    // Check for session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
        session_unset();
        session_destroy();
        header("Location: auth.php");
        exit();
    }
    $_SESSION['last_activity'] = time();

    // Handle manual logout
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: auth.php");
        exit();
    }

    // Login logic
    if (isset($_POST["login_submit"])) {
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

    // Registration logic
    if (isset($_POST["register_submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Prepare the SQL statement using MySQLi
        $stmt = $con->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $userAlreadyExists = $result->num_rows > 0;

        // Function to register the user
        function registerUser($username, $email, $password){
            global $con;
            $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
        }

        if (!$userAlreadyExists) {
            registerUser($username, $email, $password);
            echo "Registration successful!";
        } else {
            echo "User already exists";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./authentication.css">
    <link rel="stylesheet" href="./nav_bar.css"/>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
</head>
<body>
<ul class="navbar">
      <li class="navbarimg"><a href="index.php"><img src="pictures/Logo_Stylung-Photoroom.png" width="50" height="50"></a></li>
      <li class="navbar"><a href="shopsite.php">Produkte</a></li>
      <li class="navbar"><a href="shopsite.php?gender=MALE">Männer</a></li>
      <li class="navbar"><a href="shopsite.php?gender=FEMALE">Frauen</a></li>
      <li class="navbar" style="float: right">
        <?php if (isset($_SESSION["username"])): ?>
          <!-- Bild anzeigen wenn eingeloggt -->
          <a href="auth.php"><img src="pictures/usericon.svg" alt="Profil" width="15" height="15"></a>
        <?php else: ?>
          <!-- Login Text wenn nicht eingeloggt -->
          <a class="active" href="auth.php">Login</a>
        <?php endif; ?>
      </li>
      <li class="navbar" style="float: right"><a href="contact.php">Kontakt</a></li>
</ul>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Login Form -->
            <form action="auth.php" class="sign-in-form" method="POST">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="username" id="username" type="text" placeholder="Enter your Username" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password" id="password" type="password" placeholder="Enter the Password" required />
                </div>
                <input type="submit" value="Login" class="btn solid" name="login_submit"/>
            </form>

            <!-- Register Form -->
            <!-- Register Form -->
<form action="auth.php" class="sign-up-form" method="POST">
    <h2 class="title">Sign up</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input name="firstName" type="text" placeholder="First Name" required />
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input name="lastName" type="text" placeholder="Last Name" required />
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input name="username" type="text" placeholder="User Name" required />
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input name="email" type="email" placeholder="Email" required />
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input name="password" id="register-password" type="password" placeholder="Password" required />
    </div>
    <div class="password-strength">
        <div id="strength-bar"></div>
        <span id="strength-text"></span>
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input name="address" type="text" placeholder="Address" />
    </div>
    <input type="submit" class="btn" value="Sign up" name="register_submit"/>
</form>
        </div>
    </div>

    <!-- Panels -->
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <p>Please create a new account</p>
                <button class="btn transparent" id="sign-up-btn">Sign up</button>
            </div>
            <img src="pictures/Logo_Stylung-Photoroom.png" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>Are you already one of us?</h3>
                <p>Please log in</p>
                <button class="btn transparent" id="sign-in-btn">Sign in</button>
            </div>
            <img src="pictures/Logo_Stylung-Photoroom.png" class="image" alt=""/>
        </div>
    </div>
</div>

<!-- JS für UI-Wechsel -->
<script src="./app.js"></script>
</body>
</html>