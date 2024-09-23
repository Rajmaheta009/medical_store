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
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">froduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">wroduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">qroduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">croduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">rroduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">aroduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name"><a href="product_detail.php">mroduct Name 1</a></h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
        <!-- Repeat other product cards here -->
    </div>
</div>

<script>
    // Function to navigate to cart
    function cart() {
        window.location.href = 'cart.php';
    }

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