<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
</head>
<body >
<?php include 'navbar.php'; ?>
    <h1>Warenkorb von <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']); 
                echo "Gast"; 
            }
        ?></h1>
    
</body>
</html>