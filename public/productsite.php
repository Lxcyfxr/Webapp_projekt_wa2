<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="productsite_style.css">
    <title>Produktdetails</title>
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body style="background: #141b27; color: white;">
    <?php include 'navbar.php'; ?>
    <div class="product-details-container">
        <div class="product-details-left">
            <div class="product-box-large">
                <img src="path/to/product-image.jpg" alt="Produktname">
                <h3>Produktname</h3>
                <p>Preis</p>
            </div>
        </div>

        <div class="product-details-right">
            <h2>Produktname</h2>
            <p>Produktbeschreibung</p>
            <button class="add-to-cart-btn">In den Warenkorb</button>
        </div>
    </div>
    
    <script>
        function loadProduct(id) {
            $.ajax({
                url: './backend.php', // URL zur backend.php
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Produkt basierend auf der ID filtern
                    const product = data.find(p => p.id === id);

                    if (product) {
                        $('.product-box-large img').attr('src', product.picture).attr('alt', product.name);
                        $('.product-box-large h3').text(product.name);
                        $('.product-box-large p').text(parseFloat(product.price).toFixed(2) + ' €');
                        $('.product-details-right h2').text(product.name);
                        $('.product-details-right p').text(product.description);
                    } else {
                        $('.product-details-container').html('<p>Kein Produkt mit dieser ID</p>');
                    }
                },
                error: function() {
                    $('.product-details-container').html('<p>Fehler beim Laden der Produktdaten.</p>');
                }
            });
        }

        // Produkt-ID aus der URL abrufen
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');

        if (productId) {
            loadProduct(productId); // Produkt laden
        } else {
            $('.product-details-container').html('<p>Keine Produkt-ID angegeben.</p>');
        }
    </script>
</body>
</html>