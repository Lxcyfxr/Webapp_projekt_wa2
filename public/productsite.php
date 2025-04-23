<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktseite</title>
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body style="background: #141b27; color: white; font-family: Arial, sans-serif;">
    <h1>Produktdetails</h1>
    <div id="product-details">
        <p>Produktinformationen werden geladen...</p>
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
                        $('#product-details').html(
                            '<h2>' + product.name + '</h2>' +
                            '<img src="' + product.picture + '" alt="' + product.name + '" style="max-width: 300px; display: block; margin: 20px 0;">' +
                            '<p>' + product.description + '</p>' +
                            '<p>Preis: ' + parseFloat(product.price).toFixed(2) + ' €</p>'
                        );
                    } else {
                        $('#product-details').html('<p>Kein Produkt mit dieser ID</p>');
                    }
                },
                error: function() {
                    $('#product-details').html('<p>Fehler beim Laden der Produktdaten.</p>');
                }
            });
        }

        // Produkt-ID aus der URL abrufen
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');

        if (productId) {
            loadProduct(productId); // Produkt laden
        } else {
            $('#product-details').html('<p>Keine Produkt-ID angegeben.</p>');
        }
    </script>
</body>
</html>


<!-- id fängt bei 26 an -->