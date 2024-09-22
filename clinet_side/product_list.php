<?php include 'include/header.php' ?>
<div class="p_header">
    <h1>Shop</h1>
</div>
<div class="container py-5">
    <div class="input-group mb-3 w-25">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
        <button class="btn " type="button" id="button-addon2" style="margin-left:2px; background-color:#65c5e4; color:aliceblue;">
            <i class="fas fa-search"></i>
        </button>
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #65c5e4; color:antiquewhite; margin-left:5px;">
            Filter
        </button>
        <ul class="dropdown-menu" style="background-color: #65c5e4;">
            <li><a class="dropdown-item">product Name A-z </a></li>
            <li><a class="dropdown-item">product Name Z-a</a></li>
        </ul>
    </div>
    <div class="row row-col-md-3 g-4 py-5" style="justify-content:space-between;">
        <div class="col-auto product-card">
            <div class="card1">
                <div class="image">
                    <img src="assets/image/p_image.jpg" alt="Product Image">
                    <button class="add-to-cart-btn" onclick="cart()">Add to Cart</button>
                </div>
                <div class="description">
                    <h6 class="product-name">Product Name 1</h6>
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
                    <h6 class="product-name">Product Name 1</h6>
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
                    <h6 class="product-name">Product Name 1</h6>
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
                    <h6 class="product-name">Product Name 1</h6>
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
                    <h6 class="product-name">Product Name 1</h6>
                    <h6>Product Type</h6>
                    <h6>Product Price</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Prevent the Add Cart button from triggering the link
    function cart() {
        window.location.href = 'cart.php';
    }
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

    function cart() {
        window.location.href = 'cart.php';
    }
</script>
<?php include 'include/fotter.php' ?>