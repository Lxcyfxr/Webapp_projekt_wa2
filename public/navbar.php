<!--Last Change:    -->
<!--Reason:         -->
<?php
  // Start the session only if it hasn't been started already
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="navbar.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
  </head>
  <body>
    <ul class="navbar">
      <li class="navbarimg"><a href="index.php"><img src="pictures/Logo_Stylung-Photoroom.png" width="52"></a></li>
      <li class="navbar outfit-300"><a class="classic" href="shopsite.php">Produkte</a></li>
      <li class="navbar outfit-300"><a class="classic" href="shopsite.php?gender=MALE">Männer</a></li>
      <li class="navbar outfit-300"><a class="classic" href="shopsite.php?gender=FEMALE">Frauen</a></li>
      <li class="navbar outfit-300" style="float: right">
        <?php if (isset($_SESSION["username"])): ?>
          <!-- Bild anzeigen wenn eingeloggt -->
          <a class="active" href="auth.php"><img src="pictures/usericon.svg" alt="Profil" width="19" height="19"></a>
        <?php else: ?>
          <!-- Login Text wenn nicht eingeloggt -->
          <a class="active outfit-300" href="auth.php">Login</a>
        <?php endif; ?>
      </li>
      <li class="navbar outfit-300" style="float: right"><a class="classic" href="contact.php">Kontakt</a></li>
      <li class="navbar outfit-300" style="float: right"><a class="classic" href="cart.php">Warenkorb</a></li>
    </ul>
  </body>
</html>