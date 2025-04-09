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
    <link rel="stylesheet" href="nav_bar.css">
</head>
<body>
<ul>
      <li><a href="index.html"> <img src="pictures/zuhause.png" width="20" height="20"></a></li>
      <li><a>Herren</a></li>
      <!--Keine Weiterleitung zu einer anderen Seite! Eher Filtereinstellung für die Kleiderübersicht-->
      <li><a>Damen</a></li>
      <!--Keine Weiterleitung zu einer anderen Seite! Eher Filtereinstellung für die Kleiderübersicht-->
      <li style="float: right"><a class="active" href="login.php">Login</a></li>
      <!--Login/Profil-->
      <li style="float: right"><a href="contact.html">Kontakt</a></li>
    </ul>
    <form action="login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login" name="submit>
    </form>
</body>
</html>