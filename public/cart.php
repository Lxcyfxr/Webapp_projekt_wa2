<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Stylung</title>
    <link
      rel="icon"
      href="/public/pictures/Logo_Stylung.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./cart.css" />
    <script src=./jquery-3.7.1.min.js></script>
  </head>
  <body style="padding-top: 2rem">
    <?php include 'navbar.php'; ?>
    <h1>
      Warenkorb von
      <?php 
            if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);} 
            else{echo "Gast";}    
        ?>
    </h1>
    <div class="warenkorbitems">
      <div class="product">
        <img class="cartimg" src="/public/pictures/Logo_Stylung.png" alt="" />
        <div class="desc">
          <h2>Produktname</h2>
          <p>Beschreibung</p>
          <p>Größe</p>
        </div>
        <div class="delops">
          <button id="del">Delete</button>
          <div class="ops">
            <button>+</button>
            <p>zahl</p>
            <button>-</button>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function () {
            function loadCart() {
                $.ajax({
                    url: './../cart_backend.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        const cartContainer = $('.warenkorbitems');
                        cartContainer.empty();

                        data.forEach(product => {
                            const productHTML = `
                                <div class="product">
                                    <img class="cartimg" src="${product.picture}"/>
                                    <div class="desc">
                                        <h2>${product.name}</h2>
                                        <p>${product.description}</p>
                                        <p>Preis: ${product.price} €</p>
                                        <p>Größe: ${product.size}</p>
                                    </div>
                                    <div class="delops">
                                        <button class="delete-btn">Delete</button>
                                        <div class="ops">
                                            <button class="increase-btn">+</button>
                                            <p>${product.amount}</p>
                                            <button class="decrease-btn">-</button>
                                        </div>
                                    </div>
                                </div>`;
                            cartContainer.append(productHTML);
                        });
                    },
                    error: function (xhr, status, error) {
                        alert('Fehler beim Laden des Warenkorbs.');
                    }
                });
            }

            loadCart();
        });
      </script>
      </div>
  </body>
</html>
