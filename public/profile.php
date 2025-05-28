<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/profile.css">
</head>
<?php include 'navbar.php'; 
require("../session_timeout.php");?>
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
        $stmt = $con->prepare("SELECT * FROM users WHERE username=?");
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
        <div style="display: flex; justify-content: center; width: 90%; gap: 2rem;">
            <div class="form" style="margin-top: 1rem;">
                <form action="../product_add.php" method="POST" enctype="multipart/form-data" style="margin-top: 1rem;">
                    <h2 class="outfit-300">Produkt hinzufügen</h2>
                    <input class="outfit-300" type="text" name="product_name" placeholder="Produktname" required />
                    <textarea class="outfit-300" name="description" placeholder="Beschreibung" required></textarea>
                    <label for="image_file_add" class="custom-file-upload outfit-300" id="label_image_file_add">
                        Bild hochladen
                    </label>
                    <input type="file" name="image_file" id="image_file_add" accept="image/*" required>
                    <input class="outfit-300" type="number" name="price" min="0" placeholder="Preis" step="0.01" required />
                    <select class="outfit-300" name="gender">
                        <option value="">Geschlecht (optional)</option>
                        <option value="MALE">Männer</option>
                        <option value="FEMALE">Frauen</option>
                    </select>
                    <div class="size-selection outfit-300">
                        <div class="size-checkboxes">
                            <label>Verfügbare Größen:</label>
                            <label><input type="checkbox" name="sizes[]" value="XS"> XS</label>
                            <label><input type="checkbox" name="sizes[]" value="S"> S</label>
                            <label><input type="checkbox" name="sizes[]" value="M"> M</label>
                            <label><input type="checkbox" name="sizes[]" value="L"> L</label>
                            <label><input type="checkbox" name="sizes[]" value="XL"> XL</label>
                        </div>
                    </div>
                    <input class="outfit-300" type="text" name="brand" placeholder="Marke (optional)" />
                    <button class="outfit-300" type="submit">Bestätigen</button>
                </form>
            </div>
            <div class="form" style="margin-top: 1rem;">
                <form action="../product_update.php" method="POST" style="margin-top: 1rem;">
                    <h2 class="outfit-300">Produkt aktualisieren</h2>
                    <input class="outfit-300" type="number" name="product_id" placeholder="Produkt-ID" required />
                    <input class="outfit-300" type="text" name="product_name" placeholder="Neuer Produktname (optional)" />
                    <textarea class="outfit-300" name="description" placeholder="Neue Beschreibung (optional)"></textarea>
                    <label for="image_file_update" class="custom-file-upload outfit-300" id="label_image_file_update">
                        Bild hochladen (optional)
                    </label>
                    <input type="file" name="image_file" id="image_file_update" accept="image/*">
                    <input class="outfit-300" type="number" min="0" name="price" placeholder="Neuer Preis (optional)" step="0.01" />
                    <select class="outfit-300" name="gender">
                        <option value="">Geschlecht (optional)</option>
                        <option value="MALE">Männer</option>
                        <option value="FEMALE">Frauen</option>
                    </select>
                    <div class="size-selection outfit-300">
                        <div class="size-checkboxes">
                            <label>Verfügbare Größen:</label>
                            <label><input type="checkbox" name="sizes[]" value="XS"> XS</label>
                            <label><input type="checkbox" name="sizes[]" value="S"> S</label>
                            <label><input type="checkbox" name="sizes[]" value="M"> M</label>
                            <label><input type="checkbox" name="sizes[]" value="L"> L</label>
                            <label><input type="checkbox" name="sizes[]" value="XL"> XL</label>
                        </div>
                    </div>
                    <input class="outfit-300" type="text" name="brand" placeholder="Marke (optional)" />
                    <button class="outfit-300" type="submit">Bestätigen</button>
                </form>
            </div>
            <div class="form" style="margin-top: 1rem;">
                <form action="../product_delete.php" method="POST" style="margin-top: 1rem;">
                    <h2 class="outfit-300">Produkt löschen</h2>
                    <input class="outfit-300" type="number" name="product_id" placeholder="Produkt-ID" required />
                    <button class="outfit-300" type="submit">Bestätigen</button>
                </form>
            </div>
        </div>
        <h1 class="outfit-300">Benutzerverwaltung</h1>
        <div style="display: flex; justify-content: center; width: 90%; gap: 2rem;">
            <div class="form" style="margin-top: 1rem;">
                <form action="../user_admin.php" method="POST" style="margin-top: 1rem;">
                    <h2 class="outfit-300">User Rolle ändern</h2>
                    <input class="outfit-300" type="text" name="username" placeholder="Username" required />
                    <select class="outfit-300" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <button class="outfit-300" type="submit">Bestätigen</button>
                </form>
            </div>
            <div class="outfit-300 user-list" style="margin-top: 1rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                    <input type="text" class="outfit-300" id="user-search" placeholder="User suchen..." style="width:60%; max-width:300px; padding:0.5rem; border-radius:5px; border:none;">
                    <button id="user-export" class="outfit-300" style="padding:0.5rem 1rem; border-radius:5px; border:none; background:#c580f7; color:white; cursor:pointer;">JSON Export</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Rolle</th>
                        </tr>
                    </thead>
                    <tbody id="userlist"></tbody>
                </table>
            </div>
        </div>
        ';

    }else {

        echo ' 
        <img src="pictures/usericon.svg" alt="Profil" width="100" height="100">
        <p class="outfit-300 success-message" id="message-container"></p>
        <div style="display: flex; justify-content: center; align-items: flex-start; width: 90%; gap: 2rem; margin-top: 2rem;">
            <div class="form" style="min-width:300px; flex:1;">
                <form class="profile" action="user_edit.php" method="POST" style="margin-top: 1rem;">
                    <h2 class="outfit-300">Persönliche Informationen</h2>
                    <input class="outfit-300" type="text" name="vorname" placeholder="Vorname" required value="' . htmlspecialchars($userData['firstName'] ?? '') . '" />
                    <input class="outfit-300" type="text" name="nachname" placeholder="Nachname" required value="' . htmlspecialchars($userData['lastName'] ?? '') . '" />
                    <input class="outfit-300" type="text" name="username" placeholder="Username" required value="' . htmlspecialchars($userData['username'] ?? '') . '" readonly />
                    <input class="outfit-300" type="email" name="email" placeholder="E-Mail" required value="' . htmlspecialchars($userData['email'] ?? '') . '" />
                    <button class="outfit-300" type="submit">Ändern</button>
                </form>
            </div>';

        if (isset($userData['id'])) {
            echo '<div class="form" style="min-width:300px; flex:1; margin-left:2rem;">';
            include 'order_history.php';
            echo '</div>';
        }

        echo '</div>';
    }
    ?>
    <form action="auth.php" class="logout-form" method="POST">
        <h1><input type="submit" value="Logout" class="btn solid" name="logout"/></h1>
    </form>
    
    <script src="/js/jquery-3.7.1.min.js"></script>
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
        $(document).ready(function () {
          console.log("jQuery is working!");

          

          function loadUsers(searchQuery = "") {
            $.ajax({
              url: "../user_list.php",
              method: "GET",
              dataType: "json",
              success: function (data) {
                // Filterlogik
                const filteredUsers = data.filter(
                  (user) =>
                    user.username.toLowerCase().includes(searchQuery.toLowerCase())
                );
                let userlist = "";


                filteredUsers.forEach(function (user) {
                  userlist += `
                    <tr>
                      <td>${user.username}</td>
                      <td>${user.email}</td>
                      <td>${user.role}</td>
                    </tr>
                  `;
                });
                $("#userlist").html(userlist);
              },
              error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
              },
            });
        }

        $("#user-search").on("input", function () {
            const searchQuery = $(this).val();
            currentPage = 1;
            loadUsers(searchQuery);
        });
        
        $("#user-export").on("click", function () {
            const search = $("#user-search").val();
            let url = "../export_json.php";
            if (search) {
                url += "?search=" + encodeURIComponent(search);
            }
            window.open(url, "_blank");
        });

        loadUsers();
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Für Produkt hinzufügen
            const fileInputAdd = document.getElementById('image_file_add');
            const labelAdd = document.getElementById('label_image_file_add');
            if (fileInputAdd && labelAdd) {
                fileInputAdd.addEventListener('change', function () {
                    labelAdd.textContent = this.files[0] ? this.files[0].name : 'Bild hochladen';
                });
            }
            // Für Produkt aktualisieren
            const fileInputUpdate = document.getElementById('image_file_update');
            const labelUpdate = document.getElementById('label_image_file_update');
            if (fileInputUpdate && labelUpdate) {
                fileInputUpdate.addEventListener('change', function () {
                    labelUpdate.textContent = this.files[0] ? this.files[0].name : 'Bild hochladen';
                });
            }
        });
    </script>
</body>
</html>