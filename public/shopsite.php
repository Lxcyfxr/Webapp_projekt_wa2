<!DOCTYPE html>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
  </head>
  <body style="background: #333; color: white">
    <?php include 'navbar.html'; ?>
    <script src="jquery-3.7.1.min.js"></script>
    <h1 style="padding-top: 3%">Shopseite</h1>
    <div width=80%>
      <!-- test für produktintegration -->
      <h2>Product List</h2>
      <ul id="product-list"></ul>
      <script>
          $(document).ready(function() {
            console.log("jQuery is working!");
          });
          $(document).ready(function() {
            $.ajax({
              url: '../backend.php',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  data.forEach(function(product) {
                      $('#product-list').append(
                          `<li><img src=${product.image}> ${product.name}</li>`
                      );
                  });
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