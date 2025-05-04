<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <link rel="stylesheet" href="profile.css">
</head>
<?php include 'navbar.php'; ?>
<body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 3%">
    
    <h1 class="outfit-300 Headline">Profil von  <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);
            }
        ?>
    </h1>
    <?php
    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
        echo '
        <h1 class="outfit-300">Produkte verwalten</h1>
        <form action="product_add.php" method="POST" style="margin-top: 1rem;">
            <h2 class="outfit-300">Produkte hinzufügen</h2>
            <input type="text" name="product_name" placeholder="Produktname" required />
            <input type="text" name="description" placeholder="Beschreibung" required />
            <input type="text" name="image_url" placeholder="Bild-URL" required />
            <input type="number" name="price" placeholder="Preis" step="0.01" required />
            <select name="gender">
                <option value="">Geschlecht (optional)</option>
                <option value="MALE">Männer</option>
                <option value="FEMALE">Frauen</option>
            </select>
            <input type="text" name="size" placeholder="Größe (optional)" />
            <input type="text" name="brand" placeholder="Marke (optional)" />
            <button type="submit" style="margin-top: 0.5rem;">Bestätigen</button>
        </form>
        <form action="product_delete.php" method="POST" style="margin-top: 1rem;">
            <h2 class="outfit-300">Produkte löschen</h2>
            <input type="number" name="product_id" placeholder="Produkt-ID" required />
            <button type="submit" style="margin-top: 0.5rem;">Bestätigen</button>
        </form>
        ';
    }
    ?>

    <form action="auth.php" class="logout-form" method="POST">
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