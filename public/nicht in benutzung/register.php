<!--Last Change:    -->
<!--Reason:         -->
<?php
    require("connection.php");

    if(isset($_POST["submit"])){
        var_dump($_POST);

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

        if(!$userAlreadyExists){
            registerUser($username, $email, $password);
        } else {
            echo "User already exists";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/authentication.css">
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Register Form -->
            <form action="register.php" class="sign-up-form" method="POST">
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
                <input type="submit" class="btn" value="Sign up" name="submit"/>
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