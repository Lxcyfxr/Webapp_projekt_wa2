<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stylung</title>
    <link
      rel="icon"
      href="/public/pictures/Logo_Stylung.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./cart.css" />
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

    <div class="product">
      <img class= "cartimg" src="/public/pictures/Logo_Stylung.png" alt="" />
      <div class="desc">
        <h2>Produktname</h2>
        <p>Beschreibung</p>
      </div>
      <div class="delops">
        <button id="del">Delete</button>
        <div class="ops"><button>add</button>
        <p>zahl</p>
        <button>minus</button></div>
        
      </div>
    </div>
  </body>
</html>

<!-- überprüfen -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Produkte aus der Datenbank abrufen
    fetch('fetch_cart.php')
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('products-container');

        if (data.error) {
          container.innerHTML = `<p>Fehler: ${data.error}</p>`;
          return;
        }

        // Produkte dynamisch hinzufügen
        data.forEach(product => {
          const productDiv = document.createElement('div');
          productDiv.classList.add('product');

          productDiv.innerHTML = `
            <img class="cartimg" src="${product.image}" alt="${product.product_name}" />
            <div class="desc">
              <h2>${product.product_name}</h2>
              <p>${product.description}</p>
            </div>
            <div class="delops">
              <button id="del" data-id="${product.id}">Delete</button>
              <div class="ops">
                <button>add</button>
                <p>1</p>
                <button>minus</button>
              </div>
            </div>
          `;

          container.appendChild(productDiv);
        });
      })
      .catch(error => {
        console.error('Fehler beim Abrufen der Produkte:', error);
      });
  });
</script>