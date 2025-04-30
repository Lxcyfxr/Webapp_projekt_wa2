<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
</head>
<?php include 'navbar.php'; ?>
<body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 5%">
    
    
    <h1>Profil: <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);
                
            }
        ?></h1>
    <h1>Email: (Ihre Email)</h1>
    <h1 class="outfit-300" style="padding-top: 3%">Tolles Profil</h1>
    <img src="/public/pictures/Schriftzug_Stylung.png" width="50%" alt="">
    <footer class="outfit-300">
        Danke für ihr Geld!
    </footer>
    <form action="auth.php" class="sign-in-form" method="POST">
    <h1><input type="submit" value="Logout" class="btn solid" name="logout"/></h1>
    </form>
    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
    <!-- Scriptdatei -->

    
</body>
</html>