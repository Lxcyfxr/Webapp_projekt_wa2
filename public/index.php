<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html>
  <head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <style>
      .box-container {
        display: flex;
        gap: 2rem;
        justify-content: center;
        margin-top: 40px;
      }
      .stylung-box {
        background: #1e2633;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 320px;
        transition: transform 0.2s;
      }
      .stylung-box:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
      }
      .stylung-box img {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 18px;
        background: #222;
      }
      .Outfit-600 {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 1.2rem;
        letter-spacing: 0.5px;
        color: #fff;
        text-align: center;
        color: #2cc9c2;
      }
    </style>
  </head>
  <body style="background: #141b27; color: white; display:flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 3rem">
    <img src="/public/pictures/Schriftzug_Stylung.png" alt="Stylung Logo" style="width: 600px; height: auto; margin-bottom: 20px;">
    <?php include 'navbar.php'; ?>
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
        <img src="/products/foalsch_cap.jpg"/>
        <div class="Outfit-600">Stylung ist mehr als nur Mode. Es ist ein Lebensgefühl. Minimalistisch, zeitlos, stark.</div>
      </div>
    </div>
    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
    <!-- Scriptdatei -->
  </body>
</html>