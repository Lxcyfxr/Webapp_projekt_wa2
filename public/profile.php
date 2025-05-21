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
    if (isset($_SESSION['username'])) {
    // Hole die Rolle aus der Datenbank
    $con = new mysqli("localhost", "root", "", "webapp_project");
    if ($con->connect_error) {
        die("Verbindung fehlgeschlagen: " . $con->connect_error);
    }
    $username = $_SESSION['username'];
    $stmt = $con->prepare("SELECT role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $role = "";
    if ($row = $result->fetch_assoc()) {
        $role = $row['role'];
    }
    $stmt->close();
    $con->close();
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
                    <input class="outfit-300" type="text" name="vorname" placeholder="Vorname" required />
                    <input class="outfit-300" type="text" name="nachname" placeholder="Nachname" required />
                    <input class="outfit-300" type="text" name="username" placeholder="Username" required />
                    <input class="outfit-300" type="text" name="profilepic_url" placeholder="Profilbild-URL" required />
                    
                
                    
                    <button class="outfit-300" type="submit">Bearbeiten</button>
                    
                </form>
                <form class="history" action="product_delete.php" method="POST" style="margin-top: 1rem;">
                    <h2 class="history outfit-300">Verlauf</h2>
                </form>
            </div>
            ';
        }}
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