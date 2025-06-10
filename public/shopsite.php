<!--Last Change:    Loris 07/05/2025-->
<!--Reason:         Seitensteuerung-->
<!DOCTYPE html>
<html>
  <head>
    <title>Stylung</title>
    <link rel="icon" href="/public/pictures/Logo_Stylung.ico" type="image/x-icon" />
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/shopsite_style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
  </head>
  <body style="background: #141b27; color: white">
    <?php include 'navbar.php'; 
    require("../backend/session_timeout.php");?>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <div width=80%>
      <div id="search-container" style="text-align: center; margin-top: 5rem;">
        <input type="text" id="search-bar" class="outfit-300" placeholder="Produkte durchsuchen..."/>
      </div>

      <div id="product-container" class="product-container"></div>

      <!-- Pagination -->
      <div id="pagination" style="text-align: center; margin-top: 20px; padding-bottom: 1rem;">
        <button id="first-page" style="margin-right: 10px;" disabled>Anfang</button>
        <button id="prev-page" style="margin-right: 10px;" disabled>Zurück</button>
        <span id="page-info" class="outfit-300">Seite: 1 / 1</span>
        <button id="next-page" style="margin-left: 10px;">Weiter</button>
        <button id="last-page" style="margin-left: 10px;">Ende</button>
      </div>

      <script>
        $(document).ready(function () {
          console.log("jQuery is working!");

          let currentPage = 1;
          const productsPerPage = 25;
          let totalProducts = 0;
          let allProducts = []; // Speichert alle Produkte für die Suche

          function truncateAtWord(text, limit) {
            if (text.length <= limit) return text;
            const truncated = text.substring(0, limit);
            return truncated.substring(0, truncated.lastIndexOf(" ")) + " ...";
          }

          function updatePageInfo() {
            const maxPage = Math.ceil(totalProducts / productsPerPage);
            $("#page-info").text(`Seite: ${currentPage} / ${maxPage}`);

            $("#prev-page, #first-page").prop("disabled", currentPage === 1);
            $("#next-page, #last-page").prop("disabled", currentPage === maxPage || maxPage === 0);
          }

          function loadProducts(filterGender = "ALL", searchQuery = "") {
            $.ajax({
              url: "../backend/backend.php",
              method: "GET",
              dataType: "json",
              success: function (data) {
                allProducts = data;

                const filteredProducts = data.filter((product) => {
                  const nameMatch = product.name.toLowerCase().includes(searchQuery.toLowerCase());
                  
                  if (filterGender === "ALL") {
                    return nameMatch;
                  } else if (filterGender === "MALE") {
                    return nameMatch && (product.gender === "MALE" || product.gender === "NULL");
                  } else if (filterGender === "FEMALE") {
                    return nameMatch && (product.gender === "FEMALE" || product.gender === "NULL");
                  }
                  return false;
                });

                totalProducts = filteredProducts.length;
                const startIndex = (currentPage - 1) * productsPerPage;
                const endIndex = startIndex + productsPerPage;
                const paginatedProducts = filteredProducts.slice(startIndex, endIndex);

                let productContent = "";
                paginatedProducts.forEach(function (product) {
                  const truncatedName = truncateAtWord(product.name, 30);
                  productContent += `
                    <a href="productsite.php?id=${product.id}" style="text-decoration: none; color: inherit;">
                      <div class="product-box">
                        <img src="${product.picture}" alt="${product.name}">
                        <h3 class="outfit-300">${truncatedName}</h3>
                        <p class="outfit-300">${product.price} €</p>
                      </div>
                    </a>`;
                });

                $("#product-container").html(productContent);

                updatePageInfo();
              },
              error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
              },
            });
          }

          const urlParams = new URLSearchParams(window.location.search);
          const genderParam = urlParams.get("gender");

          if (genderParam === "MALE" || genderParam === "FEMALE") {
            loadProducts(genderParam);
          } else {
            loadProducts();
          }

          $("#gender-filter").on("change", function () {
            const selectedGender = $(this).val();
            currentPage = 1;
            loadProducts(selectedGender);
          });

          $("#search-bar").on("input", function () {
            const searchQuery = $(this).val();
            currentPage = 1;
            loadProducts(genderParam || "ALL", searchQuery);
          });

          $("#prev-page").on("click", function () {
            if (currentPage > 1) {
              currentPage--;
              loadProducts(genderParam || "ALL", $("#search-bar").val());
              window.scrollTo({ top: 0});
            }
          });

          $("#next-page").on("click", function () {
            const maxPage = Math.ceil(totalProducts / productsPerPage);
            if (currentPage < maxPage) {
              currentPage++;
              loadProducts(genderParam || "ALL", $("#search-bar").val());
              window.scrollTo({ top: 0});
            }
          });

          $("#first-page").on("click", function () {
            if (currentPage > 1) {
              currentPage = 1;
              loadProducts(genderParam || "ALL", $("#search-bar").val());
              window.scrollTo({ top: 0});
            }
          });

          $("#last-page").on("click", function () {
            const maxPage = Math.ceil(totalProducts / productsPerPage);
            if (currentPage < maxPage) {
              currentPage = maxPage;
              loadProducts(genderParam || "ALL", $("#search-bar").val());
              window.scrollTo({ top: 0});
            }
          });
        });
      </script>
    </div>
  </body>
</html>