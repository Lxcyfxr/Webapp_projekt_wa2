<!DOCTYPE html>
<html>
  <head>
    <title>Online Shop</title>
    <meta iconv="icon" href="favicon.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
  </head>
  <body style="background: #333; color: white">
    <?php include 'navbar.html'; ?>
    <h1 style="padding-top: 3%">Home Seite</h1>
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
    
    <footer>
      Platz für aktuelle Angebote, Rabatte, Aktionen. Hier sollen auch
      Neuerscheinungen und Bestseller angezeigt werden
    </footer>
    <!-- jquery einbindung -->
    <script src="jquery-3.7.1.min.js"></script>
    <!-- Scriptdatei -->
    <scripts src="javascript.js"></scripts>
  </body>
</html>