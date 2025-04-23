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
    <link rel="stylesheet" href="nav_bar.css"/>
  </head>
  <body>
    <ul class="navbar">
      <li class="navbarimg"><a href="index.php"><img src="pictures/Logo_Stylung-Photoroom(1).png" width="50" height="50"></a></li>
      <li class="navbar"><a href="shopsite.php">Produkte</a></li>
      <li class="navbar"><a href="shopsite.php?gender=MALE">Männer</a></li>
      <li class="navbar"><a href="shopsite.php?gender=FEMALE">Frauen</a></li>
      <li class="navbar" style="float: right">
        <?php if (isset($_SESSION["username"])): ?>
          <!-- Bild anzeigen wenn eingeloggt -->
          <a href="auth.php"><img src="pictures/usericon.svg" alt="Profil" width="20" height="20"></a>
        <?php else: ?>
          <!-- Login Text wenn nicht eingeloggt -->
          <a class="active" href="auth.php">Login</a>
        <?php endif; ?>
      </li>
      <li class="navbar" style="float: right"><a href="contact.php">Kontakt</a></li>
    </ul>
  </body>
</html>