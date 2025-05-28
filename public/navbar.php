<!--Last Change:    -->
<!--Reason:         -->
<?php
  require("../session_timeout.php");
?>
<html>
  <head>
    <link rel="stylesheet" href="./css/navbar.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
  </head>
  <body>
    <ul class="navbar desktop" id="desktop-navbar">
      <li class="navbarimg desktop"><a href="index.php"><img src="pictures/Logo_Stylung-Photoroom.png" width="52"></a></li>
      <li class="navbar outfit-300 desktop"><a class="classic" href="shopsite.php">Produkte</a></li>
      <li class="navbar outfit-300 desktop"><a class="classic" href="shopsite.php?gender=MALE">Männer</a></li>
      <li class="navbar outfit-300 desktop"><a class="classic" href="shopsite.php?gender=FEMALE">Frauen</a></li>
      <li class="navbar outfit-300 desktop" style="float: right">
        <?php if (isset($_SESSION["username"])): ?>
          <!-- Bild anzeigen wenn eingeloggt -->
          <a class="active desktop" href="profile.php"><img src="pictures/usericon.svg" alt="Profil" width="19" height="19"></a>
        <?php else: ?>
          <!-- Login Text wenn nicht eingeloggt -->
          <a class="active outfit-300 desktop" href="auth.php">Login</a>
        <?php endif; ?>
      </li>
      <li class="navbar outfit-300 desktop" style="float: right"><a class="classic" href="contact.php">Kontakt</a></li>
      <li class="navbar outfit-300 desktop" style="float: right"><a class="classic" href="cart.php">Warenkorb</a></li>
    </ul>

    <ul class="navbar mobile" id="mobile-navbar">
      <li class="navbarimg mobile"><a href="index.php"><img src="pictures/Logo_Stylung-Photoroom.png" width="52"></a></li>
      <li class="navbar outfit-300 mobile dropdown" style="float: right"><a class="active outfit-300 dropbtn" href="javascript:void(0)">Menü</a>
        <div class="dropdown-content classic">
          <a class="classic mobile" href="shopsite.php">Produkte</a>
          <a class="classic mobile" href="shopsite.php?gender=MALE">Männer</a>
          <a class="classic mobile" href="shopsite.php?gender=FEMALE">Frauen</a>
          <a class="classic mobile" href="cart.php">Warenkorb</a>
          <a class="classic mobile" href="contact.php">Kontakt</a>
          <?php if (isset($_SESSION["username"])): ?>
            <a class="classic mobile" href="profile.php">Profil</a>
          <?php else: ?>
            <a class="classic mobile" href="auth.php">Login</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
  </body>
</html>