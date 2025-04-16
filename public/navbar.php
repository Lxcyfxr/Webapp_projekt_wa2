<?php
  session_start(); // Start the session to check if the user is logged in
?>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="nav_bar.css"/>
  </head>
  <body>
    <ul class="navbar">
      <li class="navbar"><a href="index.php"><img src="pictures/zuhause.png" width="15" height="15"></a></li>
      <li class="navbar"><a href="shopsite.php">Buben</a></li>
      <li class="navbar"><a href="shopsite.php">Weiber</a></li>
      <li class="navbar"><a href="shopsite.php">Kinnas</a></li>
      <li class="navbar" style="float: right">
        <?php if (isset($_SESSION["username"])): ?>
          <!-- Bild anzeigen wenn eingeloggt -->
          <a href="login.php"><img src="pictures/usericon.svg" alt="Profil" width="20" height="20"></a>
        <?php else: ?>
          <!-- Login Text wenn nicht eingeloggt -->
          <a class="active" href="login.php">Login</a>
        <?php endif; ?>
      </li>
      <li class="navbar" style="float: right"><a href="contact.php">Kontakt</a></li>
    </ul>
  </body>
</html>