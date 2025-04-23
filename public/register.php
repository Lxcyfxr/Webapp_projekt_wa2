<!--Last Change:    -->
<!--Reason:         -->
<?php
    require("connection.php");

    if(isset($_POST["submit"])){
        var_dump($_POST);

        $username = $_POST["username"];
        $email = $_POST["email"];
        


        $password = $_POST["password"];

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
            // Register the user
            registerUser($username, $email, $password);
        } else {
            // User already exists
        }

        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body style="background: #333; color: white;padding-top:3%">
    <?php include 'navbar.php'; ?>
    <form action="register.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Sign Up" name="submit">
    </form>
</body>
</html>