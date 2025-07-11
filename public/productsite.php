<!--Last Change:    -->
<!--Reason:         -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/productsite_style.css">
    <title>Produktdetails</title>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
</head>
<body style="background: #141b27; color: white;">
    <?php include 'navbar.php'; 
    require("../backend/session_timeout.php");?>
    <div class="product-details-container">
        <div class="product-details-left">
            <div class="product-box-large">
                <img src="path/to/product-image.jpg" alt="Produktname">
                <h3 class="outfit-600">Produktname</h3>
                <p class="outfit-300">Preis</p>
            </div>
        </div>

        <div class="product-details-right">
            <div class="product-info">
                <h2 class="outfit-600">Produktname</h2>
                <hr width="100%" size="1" color="#ffffff" style="margin: 0px; padding: 0px;">
                <p class="outfit-300">Produktbeschreibung</p>
            </div>
            <div style="flex-direction: row; justify-content: space-between; display: flex; gap: 2rem">
                <select id="size" name="size" required class="outfit-300">
                    <option value="">Größe wählen</option>
                </select>
                <button class="Outfit-300 add-to-cart-btn">In den Warenkorb</button>
            </div>
        </div>
    </div>
    
    <script>
        function loadProduct(id) {
            $.ajax({
                url: '../backend/backend.php', // URL zur backend.php
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

                        // Größen-Select dynamisch befüllen
                        const sizeSelect = $('#size');
                        sizeSelect.empty().append('<option value="">Größe wählen</option>');
                        
                        // Parse JSON string to array if necessary
                        const sizes = typeof product.size === 'string' ? 
                            JSON.parse(product.size) : product.size;
                        
                        sizes.forEach(size => {
                            sizeSelect.append(`<option value="${size}">${size}</option>`);
                        });
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
<!-- ajax für addtocart button -->
<script>
    $(document).ready(function () {
        $('.add-to-cart-btn').click(function () {
            //const productId = new URLSearchParams(window.location.search).get('id');
            const size = $('#size').val();

            if (!productId || !size) {
                alert('Bitte wählen Sie eine Größe aus.');
                return;
            }

            $.ajax({
                url: './backend/add_to_cart.php',
                type: 'POST',
                data: {
                    product_id: productId,
                    size: size
                },
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        window.location.href = "cart.php";
                    }
                },
                error: function (xhr,status, error) {
                    alert('Fehler beim Hinzufügen zum Warenkorb.'+ error);
                }
            });
        });
    });
</script>
</body>
</html>