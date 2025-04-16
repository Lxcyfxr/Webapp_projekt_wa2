<!DOCTYPE html>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="product_style.css">
  </head>
  <body style="background: #333; color: white">
    <?php include 'navbar.php'; ?>
    <script src="jquery-3.7.1.min.js"></script>
    <h1 style="padding-top: 3%">Shopseite</h1>
    <div width=80%>
      <div id="product-container" class="product-container"></div>
      <script>
        $(document).ready(function() {
          console.log("jQuery is working!");
          $.ajax({
            url: 'backend.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
              let productContent = '';
              data.forEach(function(product) {
                productContent += `
                  <div class="product-box">
                    <img src="${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>${product.price} €</p>
                  </div>`;
              });
              $('#product-container').html(productContent);
            },
            error: function(xhr, status, error) {
              console.error('Error fetching data:', error);
            }
          });
        });
      </script>
    </div>
  </body>
</html>