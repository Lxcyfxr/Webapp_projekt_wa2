
<!DOCTYPE html>
<html>
  <head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 3rem">
    <button id="play-music" style="margin:20px;">Für Atmospähre</button>
  <audio id="bg-music" src="/public/backgroundmusic.mp3" type="audio/mpeg"></audio>
  <script>
    document.getElementById('play-music').addEventListener('click', function() {
      document.getElementById('bg-music').play();
      this.style.display = 'none';
    });
  </script>
    <img src="/public/pictures/Schriftzug_Stylung.png" alt="Stylung Logo" style="width: 600px; height: auto; margin-bottom: 20px;">
    <?php include 'navbar.php'; 
    require("../session_timeout.php");?>
    <div class="box-container">
      <div class="stylung-box">
        <img src="/products/stylung_shirt.jpg"/>
        <div class="Outfit-600">Ein Stil, der ohne Kompromisse kommt: modern, urban und unverwechselbar.</div>
      </div>
      <div class="stylung-box">
        <img src="/products/sinsheim_shirt.jpg"/>
        <div class="Outfit-600">Egal ob Basic oder Statement - bei uns findest du deinen perfekten Streetstyle.</div>
      </div>
      <div class="stylung-box">
        <img src=""/>
        <div class="Outfit-600">Stylung ist mehr als nur Mode. Es ist ein Lebensgefühl. Minimalistisch, zeitlos, stark.</div>
      </div>
      <script>
$(document).ready(function() {
    $.ajax({
        url: '../get_products.php', // Dein PHP-API-Skript, siehe vorherige Antwort
        method: 'GET',
        dataType: 'json',
        success: function(products) {
            // Wir gehen davon aus, dass die Reihenfolge der Produkte [1,2,3] ist
            products.forEach(function(product, idx) {
                $('../products/' + (idx+1)).attr('src', product.picture);
            });
        }
    });
});
</script>
    </div>
    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
    <!-- Scriptdatei -->
  </body>
</html>