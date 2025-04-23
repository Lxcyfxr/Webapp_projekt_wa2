<!--Last Change:    Loris 23/04/2025-->
<!--Reason:         Produktweiterleitung-->
<!DOCTYPE html>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="product_style.css">
  </head>
  <body style="background: #141b27; color: white">
    <?php include 'navbar.php'; ?>
    <script src="jquery-3.7.1.min.js"></script>
    <img src="pictures/Schriftzug_Stylung.png" style="width: 5%; height: auto; display: block; margin: 0 auto; padding-top: 3%; padding-bottom: 1%">
    <div width=80%>
      <!-- Filter Dropdown -->
      <!--<div style="margin-bottom: 20px; text-align: center;">
        <label for="gender-filter" style="margin-right: 10px;">Filter nach Geschlecht:</label>
        <select id="gender-filter">
          <option value="ALL">Alle</option>
          <option value="MALE">Männlich</option>
          <option value="FEMALE">Weiblich</option>
        </select>
      </div>-->

      <div id="product-container" class="product-container"></div>
      <script>
        $(document).ready(function() {
          console.log("jQuery is working!");

          // Funktion zum Laden und Filtern der Produkte
          function loadProducts(filterGender = 'ALL') {
            $.ajax({
              url: 'backend.php',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                let productContent = '';
                data.forEach(function(product) {
                  // Filterlogik
                  if (filterGender === 'ALL' || product.gender === filterGender) {
                    productContent += `
                      <a href="productsite.php?id=${product.id}" style="text-decoration: none; color: inherit;">
                        <div class="product-box">
                          <img src="${product.image}" alt="${product.name}">
                          <h3>${product.name}</h3>
                          <p>${product.price} €</p>
                        </div>
                      </a>`;
                      
                  }
                });
                $('#product-container').html(productContent);
              },
              error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
              }
            });
          }

          // URL-Parameter auslesen
          const urlParams = new URLSearchParams(window.location.search);
          const genderParam = urlParams.get('gender');

          // Filter automatisch setzen
          if (genderParam === 'MALE' || genderParam === 'FEMALE') {
            $('#gender-filter').val(genderParam);
            loadProducts(genderParam);
          } else {
            loadProducts();
          }

          // Event-Listener für den Filter
          $('#gender-filter').on('change', function() {
            const selectedGender = $(this).val();
            loadProducts(selectedGender);
          });
        });
      </script>
    </div>
  </body>
</html>