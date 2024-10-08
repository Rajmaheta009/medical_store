<?php include 'include/header.php' ?>
<div class="p_header">
    <h1>Shop</h1>
</div>
<div class="container py-5">
    <div class="input-group mb-3 w-25 ms-auto d-flex justify-content-end">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by product name" aria-label="Search by product name" aria-describedby="button-addon2">
        <button class="btn " type="button" id="button-addon2" style="margin-left:2px; background-color:#65c5e4; color:aliceblue;">
            <i class="fas fa-search"></i>
        </button>
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #65c5e4; color:antiquewhite; margin-left:5px;">
            Filter
        </button>
        <ul class="dropdown-menu" style="background-color: #65c5e4;">
            <li><a class="dropdown-item" href="#" onclick="sortProducts('asc')">Product Name A-Z</a></li>
            <li><a class="dropdown-item" href="#" onclick="sortProducts('desc')">Product Name Z-A</a></li>
        </ul>
    </div>

    <!-- Add id="productContainer" here -->
    <div class="row row-col-md-3 g-4 py-5" id="productContainer">
        <?php
        include '../database/collaction.php';
        $products = $product_collection->find()->toArray();
        $filter_product = array_filter($products, function ($product) {
            return $product['check'] == true && $product['delete'] == false;
        });
        foreach ($filter_product as $product) { ?>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="../admin_side/assets/image/<?php echo $product['image']; ?>" alt="Product Image">
                        <a href="cart.php?id=<?php echo urlencode($product['_id']); ?>"><button class="add-to-cart-btn">Add to Cart</button></a>
                    </div>
                    <a href="product_detail.php?id=<?php echo urlencode($product['_id']); ?>">
                        <div class="description">
                            <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                            <h6><?php echo htmlspecialchars($product['type']); ?></h6>
                            <h6>$<?php echo number_format($product['selling_price'], 2); ?></h6>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Repeat other product cards here -->
</div>
</div>

<script>
    // Search filter function
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toLowerCase();
            var products = document.querySelectorAll('.product-card');

            products.forEach(function(product) {
                var productName = product.querySelector('.product-name').textContent.toLowerCase();
                if (productName.indexOf(filter) > -1) {
                    product.style.display = ''; // Show product
                } else {
                    product.style.display = 'none'; // Hide product
                }
            });
        });
    });

    // Sorting function
    function sortProducts(order) {
        var productContainer = document.getElementById('productContainer');
        var products = Array.from(document.querySelectorAll('.product-card'));

        products.sort(function(a, b) {
            var nameA = a.querySelector('.product-name').textContent.toLowerCase();
            var nameB = b.querySelector('.product-name').textContent.toLowerCase();

            if (order === 'asc') {
                return nameA.localeCompare(nameB);
            } else {
                return nameB.localeCompare(nameA);
            }
        });

        // Clear and re-append sorted products
        productContainer.innerHTML = '';
        products.forEach(function(product) {
            productContainer.appendChild(product);
        });
    }
</script>
<?php include 'include/fotter.php' ?>