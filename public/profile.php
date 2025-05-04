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
    <img src="/public/pictures/Schriftzug_Stylung.png" alt="Logo" style="width: 200px; margin-top: 2rem;" />

    <?php
    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
        echo '
        <h1 class="outfit-300" style="padding-top: 3%">Produkte verwalten</h1>
        <h2 class="outfit-300" style="padding-top: 3%">Produkte hinzufügen</h2>
        <form action="product_add.php" method="POST" style="margin-top: 1rem;">
            <input type="text" name="product_name" placeholder="Produktname" required />
            <input type="text" name="description" placeholder="Beschreibung" required />
            <input type="text" name="image_url" placeholder="Bild-URL" required />
            <input type="number" name="price" placeholder="Preis" step="0.01" required />
            <select name="gender">
                <option value="">Geschlecht (optional)</option>
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
            </select>
            <input type="text" name="size" placeholder="Größe (optional)" />
            <input type="text" name="brand" placeholder="Marke (optional)" />
            <button type="submit" style="margin-top: 0.5rem;">Bestätigen</button>
        </form>
        <h2 class="outfit-300" style="padding-top: 3%">Produkte löschen</h2>
        <form action="product_delete.php" method="POST" style="margin-top: 1rem;">
            <input type="number" name="product_id" placeholder="Produkt-ID" required />
            <button type="submit" style="margin-top: 0.5rem;">Bestätigen</button>
        </form>
        ';
    }
    ?>

    <footer class="outfit-300" style="margin-top: 3rem;">
        Danke für ihr Geld!
    </footer>
    <form action="auth.php" class="sign-in-form" method="POST">
        <h1><input type="submit" value="Logout" class="btn solid" name="logout"/></h1>
    </form>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        if (message) {
            alert(message);
        }
    </script>
    
    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
</body>
</html>