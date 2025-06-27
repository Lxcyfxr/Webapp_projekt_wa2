<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Stylung</title>
  <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

  <!-- jQuery & jQuery UI -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <style>
    body {
      background: #141b27;
      color: white;
      font-family: 'Outfit', sans-serif;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #141b27;
      text-align: center;
      padding: 10px;
    }

    a {
      color: #2cc9c2;
      text-decoration: underline;
    }

    #successPopup {
      display: none;
      position: fixed;
      top: 30%;
      left: 50%;
      transform: translate(-50%, -30%);
      background-color: #2cc9c2;
      padding: 20px;
      color: white;
      border-radius: 10px;
      z-index: 2000;
    }
  </style>
</head>
<body>

  <?php include 'navbar.php'; 
  require("../backend/session_timeout.php");?>
  <img src="pictures/Logo_Stylung-Photoroom(1).png" alt="Stylung Logo" style="width: 180px; display: block; margin: 20px auto;">

  <h1 style="padding-top: 3%; color: #2cc9c2;">Kontaktseite</h1>
  <h3>Sie können uns unter den folgenden Möglichkeiten erreichen:</h3>

  <h3 style="color: #c580f7;">E-Mail</h3>
  <p>support@stylung.de</p>

  <h3 style="color: #c580f7;">Telefon</h3>
  <p>+49 123 6969690</p>

  <h3 style="color: #c580f7;">Adresse</h3>
  <p>Musterstraße 1, 21614 Buxtehude</p>

  <h3 style="color: #c580f7;">Öffnungszeiten</h3>
  <p>Montag - Freitag: 04:20 - 15:00 Uhr</p>

  <footer>
    <hr>
    <p>
      Impressum |
      <a href="#" id="openForm">Kontaktformular</a> |
      Datenschutz
    </p>
  </footer>

  <!-- Das Dialogformular -->
  <div id="kontaktformular" title="Kontaktformular" style="display: none; background-color: #2cc9c2;">
    <form id="contactForm">
      <label for="email">E-Mail:</label><br>
      <input type="email" name="email" id="email" required style="width: 100%; padding: 5px; background-color: #c580f7"><br><br>

      <label for="problem">Problem:</label><br>
      <textarea name="problem" id="problem" rows="4" required style="width: 100%; padding: 5px; background-color: #c580f7"></textarea><br><br>
    </form>
  </div>

  <!-- Erfolgsnachricht -->
  <div id="successPopup">
    <p>Danke für Ihre Nachricht! Das Stylungs Team meldet sich schnell bei Ihnen.</p>
    <button onclick="$('#successPopup').fadeOut()">Schließen</button>
  </div>

  <script>
    $(document).ready(function () {
      $("#openForm").on("click", function (e) {
        e.preventDefault();

        $("#kontaktformular").dialog({
          modal: true,
          width: 400,
          resizable: false,
          draggable: false,
          buttons: {
            "Absenden": function () {
              $.ajax({
                url: '../backend/contact_send.php',
                method: 'POST',
                data: $("#contactForm").serialize(),
                dataType: 'json',
                success: function (response) {
                  if (response.success) {
                    $("#kontaktformular").dialog("close");
                    $("#successPopup").fadeIn();

                    setTimeout(() => {
                      $("#successPopup").fadeOut();
                    }, 5000);

                    $("#contactForm")[0].reset();
                  } else {
                    alert("Fehler: " + response.message);
                  }
                },
                error: function () {
                  alert("Es gab ein Problem beim Senden des Formulars.");
                }
              });
            },
            "Abbrechen": function () {
              $(this).dialog("close");
            }
          }
        });
      });
    });
  </script>

</body>
</html>

