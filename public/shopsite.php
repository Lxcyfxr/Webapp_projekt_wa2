<!DOCTYPE html>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body style="background: #333; color: white">
    <?php include 'navbar.html'; ?>
    <h1 style="padding-top: 3%">Shopseite</h1>
    <div width=90%>
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
                          `<li>${product.name} - ${product.description}</li>`
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