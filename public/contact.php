<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html>
  <head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <meta charset="UTF-8" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
  </head>
  <body style="background: #141b27; color: white;font-family: Outfit, sans-serif; font-optical-sizing: auto; font-weight: 300; font-style: normal;">
    <?php include 'navbar.php'; ?>
    <img src="pictures/Logo_Stylung-Photoroom(1).png" alt="Stylung Logo" style="width: 180px; display: block; margin: 20px auto;">
    
    <h1 style="padding-top: 3%; color: #2cc9c2">Kontaktseite</h1>
    <h3>Sie können uns unter den folgenden Möglichkeiten erreichen:</h3>

    <h3 style="color: #c580f7;">E-Mail</h3>
    <p>support@stylung.de</p>

    <h3 style="color: #c580f7;">Telefon</h3>
    <p>+49 123 6969690</p>

    <h3 style="color: #c580f7;">Adresse</h3>
    <p>Musterstraße 1, 21614 Buxtehude</p>

    <h3 style="color: #c580f7;">Öffnungszeiten</h3>
    <p>Montag - Freitag: 04:20 - 15:00 Uhr</p>

    <footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #141b27; color: white; text-align: center; padding: 10px;">
    <hr>
    <p>
      <a href="impressum.php" style="color: #2cc9c2; text-decoration: underline;">Impressum</a>    | 
      <a href="#" onclick="toggleForm(); return false;" style="color: #2cc9c2; text-decoration: underline;">Kontaktformular</a> | 
      Datenschutz
    </p>

    </footer>


<div id="kontaktformular" style="display: none; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -20%); background-color: #1f2a3a; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px #2cc9c2; z-index: 1000; width: 300px;">
  <h3 style="color: #2cc9c2;">Kontaktformular</h3>
  <form action="contact_send.php" method="post">
    <label for="email">E-Mail:</label><br>
    <input type="email" name="email" id="email" required style="width: 100%; padding: 5px;"><br><br>

    <label for="problem">Problem:</label><br>
    <textarea name="problem" id="problem" rows="4" required style="width: 100%; padding: 5px;"></textarea><br><br>

    <button type="submit" style="background-color: #2cc9c2; color: white; border: none; padding: 8px 16px; border-radius: 8px;">Absenden</button>
    <button type="button" onclick="toggleForm()" style="margin-left: 10px; background-color: #555; color: white; border: none; padding: 8px 16px; border-radius: 8px;">Abbrechen</button>
  </form>
</div>

<script>
function toggleForm() {
  const form = document.getElementById('kontaktformular');
  form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>

  </body>
</html>
