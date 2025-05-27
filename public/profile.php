<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/profile.css">
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
    // Hole Userdaten aus DB, falls eingeloggt
    $userData = null;
    if (isset($_SESSION['username'])) {
        require_once("../connection.php");
        $stmt = $con->prepare("SELECT username, email, role, firstName, lastName, address FROM users WHERE username=?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        if ($userData) {
        $role = $userData['role'];
    }
        $stmt->close();
    }
    
        if ($role === 'admin') {
        echo '
        <h1 class="outfit-300">Produktverwaltung</h1>
        <p class="outfit-300 success-message" id="message-container"></p>
        <div style="display: flex; justify-content: center; width: 90%; gap: 2rem; margin-top: 2rem;">
            <form action="product_add.php" method="POST" style="margin-top: 1rem;">
                <h2 class="outfit-300">Produkt hinzufügen</h2>
                <input class="outfit-300" type="text" name="product_name" placeholder="Produktname" required />
                <textarea class="outfit-300" name="description" placeholder="Beschreibung" required></textarea>
                <input class="outfit-300" type="text" name="image_url" placeholder="Bild-URL" required />
                <input class="outfit-300" type="number" name="price" placeholder="Preis" step="0.01" required />
                <select class="outfit-300" name="gender">
                    <option value="">Geschlecht (optional)</option>
                    <option value="MALE">Männer</option>
                    <option value="FEMALE">Frauen</option>
                </select>
                <input class="outfit-300" type="text" name="size" placeholder="Größe (optional)" />
                <input class="outfit-300" type="text" name="brand" placeholder="Marke (optional)" />
                <button class="outfit-300" type="submit">Bestätigen</button>
            </form>
            <form action="product_update.php" method="POST" style="margin-top: 1rem;">
                <h2 class="outfit-300">Produkt aktualisieren</h2>
                <input class="outfit-300" type="number" name="product_id" placeholder="Produkt-ID" required />
                <input class="outfit-300" type="text" name="product_name" placeholder="Neuer Produktname (optional)" />
                <textarea class="outfit-300" name="description" placeholder="Neue Beschreibung (optional)"></textarea>
                <input class="outfit-300" type="text" name="image_url" placeholder="Neue Bild-URL (optional)" />
                <input class="outfit-300" type="number" name="price" placeholder="Neuer Preis (optional)" step="0.01" />
                <select class="outfit-300" name="gender">
                    <option value="">Geschlecht (optional)</option>
                    <option value="MALE">Männer</option>
                    <option value="FEMALE">Frauen</option>
                </select>
                <input class="outfit-300" type="text" name="size" placeholder="Größe (optional)" />
                <input class="outfit-300" type="text" name="brand" placeholder="Marke (optional)" />
                <button class="outfit-300" type="submit">Bestätigen</button>
            </form>
            <form action="product_delete.php" method="POST" style="margin-top: 1rem;">
                <h2 class="outfit-300">Produkt löschen</h2>
                <input class="outfit-300" type="number" name="product_id" placeholder="Produkt-ID" required />
                <button class="outfit-300" type="submit">Bestätigen</button>
            </form>
            <form action="user_admin.php" method="POST" style="margin-top: 1rem;">
                <h2 class="outfit-300">User Rolle ändern</h2>
                <input class="outfit-300" type="text" name="username" placeholder="Username" required />
                <select class="outfit-300" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button class="outfit-300" type="submit">Bestätigen</button>
            </form>
        </div>
        ';
    }else {
        echo ' 
        <img src="pictures/usericon.svg" alt="Profil" width="100" height="100">
        <p class="outfit-300 success-message" id="message-container"></p>
        <div style="display: flex; justify-content: center; width: 90%; gap: 2rem; margin-top: 2rem;">
            <form class="profile" action="product_add.php" method="POST" style="margin-top: 1rem;">
                <h2 class="outfit-300">Persönliche Informationen</h2>
                 <select class="outfit-300" name="gender">
                    <option value="">Anrede</option>
                    <option value="MALE">Herr</option>
                    <option value="FEMALE">Frau</option>
                </select>
                <input class="outfit-300" type="text" name="vorname" placeholder="Vorname" required value="' . htmlspecialchars($userData['firstName'] ?? '') . '" readonly />
                <input class="outfit-300" type="text" name="nachname" placeholder="Nachname" required value="' . htmlspecialchars($userData['lastName'] ?? '') . '" readonly />
                <input class="outfit-300" type="text" name="username" placeholder="Username" required value="' . htmlspecialchars($userData['username'] ?? '') . '" readonly />
                <input class="outfit-300" type="email" name="email" placeholder="E-Mail" required value="' . htmlspecialchars($userData['email'] ?? '') . '" readonly />
                <input class="outfit-300" type="text" name="profilepic_url" placeholder="Profilbild-URL" required />
                <button class="outfit-300" type="submit">Bearbeiten</button>
            </form>
            <form class="history" action="product_delete.php" method="POST" style="margin-top: 1rem;">
                <h2 class="history outfit-300">Verlauf</h2>
            </form>
        </div>
        ';
    }
    ?>
    <form action="auth.php" class="logout-form" method="POST">
        <h1><input type="submit" value="Logout" class="btn solid" name="logout"/></h1>
    </form>
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            const messageContainer = document.getElementById('message-container');

            if (message) {
                messageContainer.textContent = message;
                messageContainer.style.display = 'block';
                setTimeout(function() {
                    document.getElementById("message-container").style.display = "none";
                }, 3000);

                const forms = document.querySelectorAll('form');
                forms.forEach(form => form.reset());

                const newUrl = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>

    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
</body>
</html>