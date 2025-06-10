
<!DOCTYPE html>
<html>
  <head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    
  </head>
  <body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 3rem">
  <body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 3rem">
    <img src="/public/pictures/Schriftzug_Stylung.png" alt="Stylung Logo" style="width: 400px; height: auto; margin-bottom: 20px;">
    <?php include 'navbar.php'; 
    require("../backend/session_timeout.php");?>
    <div class="box-container">
      <a href="productsite.php?id=2" style="text-decoration: none; color: inherit;">
        <div class="stylung-box">
          <img id="img-1" src="/products/product2.jpg"/>
          <div class="Outfit-300">Ein Stil, der ohne Kompromisse kommt: modern, urban und unverwechselbar.</div>
        </div>
      </a>
      <a href="productsite.php?id=1" style="text-decoration: none; color: inherit;">
        <div  class="stylung-box">
          <img id="img-2" src="/products/product1.png"/>
          <div class="Outfit-300">Egal ob Basic oder Statement - bei uns findest du deinen perfekten Streetstyle.</div>
        </div>
      </a>
      <a href="productsite.php?id=3" style="text-decoration: none; color: inherit;">
        <div  class="stylung-box">
          <img id="img-3" src="/products/product3.png"/>
          <div class="Outfit-300">Stylung ist mehr als nur Mode. Es ist ein Lebensgefühl. Minimalistisch, zeitlos, stark.</div>
        </div>
      </a>
      <script>
        $(document).ready(function() {
            $.ajax({
                url: '../backend/get_products.php',
                method: 'GET',
                dataType: 'json',
                success: function(products) {
                    products.forEach(function(product, idx) {
                        $('#img-' + (idx+1)).attr('src', product.picture);
                    });
                }
            });
        });
      </script>
    </div>   
  </body>
</html>