<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
</head>
<p>
    




PROFIL</p>
<form action="auth.php" class="sign-in-form" method="POST">
    <input type="submit" value="Logout" class="btn solid" name="logout"/>
</form>
<body >
<?php include 'navbar.php'; ?>
    <h1>Profil: <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);
            }
        ?></h1>
    
</body>
</html>