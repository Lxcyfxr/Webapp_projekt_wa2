<?php
    require("connection.php");


    if(isset($_POST["submit"])){
        var_dump($_POST);

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email:=email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();


        $userAlreadyExists = $stmt->fetchColumn();

        if(!$userAlreadyExists){
            //Registrieren
            registerUser($username, $email, $password);
            }
        else{
            //User exisitert schon
        }

        //User wird registriert
        function registerUser($username, $email, $password){
            global $con;
            $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            stmt->execute();

        }
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
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login" name="submit>
    </form>
</body>
</html>