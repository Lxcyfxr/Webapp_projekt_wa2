<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Stylung Kontakt</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <style>
    body {
      background-color: #1e1e1e;
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 40px;
    }

    .logo {
      display: block;
      margin: 0 auto 30px auto;
      width: 180px;
    }

    h1, h2, h3 {
      color: #c580f7; /* Lila-Farbe vom Logo */
    }

    .kontakt-info {
      background-color: #2cc9c2; /* Türkis-Grün */
      color: #000;
      padding: 20px;
      border-radius: 12px;
      max-width: 500px;
      margin: 20px auto;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      color: #aaa;
    }
  </style>
</head>
<body>
  <?php include 'navbar.html'; ?>

  <img src="Logo_Stylung-Photoroom.png" alt="Stylung Logo" class="logo">

  <h1>Kontaktseite</h1>
  <h2>Kontakt</h2>
  <?php echo "Sie können uns unter den folgenden Möglichkeiten erreichen:"; ?>

  <div class="kontakt-info">
    <h3>E-Mail</h3>
    <p>support@stylung-shop.de</p>

    <h3>Telefon</h3>
    <p>+49 123 4567890</p>

    <h3>Adresse</h3>
    <p>Graffitiweg 7, 70707 StyleCity</p>
  </div>

  <footer>
    <hr style="margin: 40px 0; border: none; border-top: 1px solid #444;">
    <p>Impressum | Kontaktformular | Datenschutz</p>
  </footer>
</body>
</html>
