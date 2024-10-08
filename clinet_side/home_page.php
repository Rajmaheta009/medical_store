<?php session_start(); // Start the session
include 'include/header.php'; ?>
<div class="container mt-4">
    <!-- Carousel -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="bottom: 22px;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://as2.ftcdn.net/v2/jpg/01/18/42/59/1000_F_118425925_n2GZJR42P1ai0p3qYmNe375LCd6kQ9R4.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://as2.ftcdn.net/v2/jpg/02/81/42/77/1000_F_281427785_gfahY8bX4VYCGo6jlfO8St38wS9cJQop.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Statistic Cards -->
    <div class="row">
        <div class="col-4">
            <div class="card" style="border:none; padding: 0px;">
                <img src="assets/image/banner.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Medical And Health</h5>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="border:none; padding: 0px;">
                <img src="assets/image/banner-1-1.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Personal Care</h5>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="border:none; padding: 0px;">
                <img src="assets/image/banner-2.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Diet And Fitness</h5>
                </div>
            </div>
        </div>
    </div>
    <h4>Featured Products</h4>
    <div class="row row-col-md-3 g-4 py-5">
        <div class="owl-carousel">
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
                            <!-- Add a form with hidden input to send product ID and other details -->
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['_id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                <a href="cart.php?id=<?php echo $product['_id']; ?>"><button class="add-to-cart-btn">Add to Cart</button></a>
                            </form>
                        </div>
                        <?php
                        $value = $product['_id'];
                        echo "<script>localStorage.setItem('product-id', '$value');</script>";
                        ?>
                        <a href="product_detail.php?id=<?php echo $product['_id']; ?>">
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
    </div>

    <div class="banner">
        <div class="banner-content">
            <h1>HAVE A QUESTION?</h1>
            <p>Your one-stop solution for all medical needs</p>
            <a href="contact_as.php" class="btn-banner">Send Message</a>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="cards">
                <div class="icon">
                    <i class="bi bi-gift-fill"></i>
                </div>
                <div class="details">
                    <h4>TAKE YOUR PRESENT</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pellentesque posuere risus lacinia tristique sed massa.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="cards">
                <div class="icon">
                    <i class="bi bi-globe2"></i>
                </div>
                <div class="details">
                    <h4>Free World Delivery</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pellentesque posuere risus lacinia tristique sed massa id.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="cards">
                <div class="icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div class="details">
                    <h4>Customer Support</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pellentesque posuere risus lacinia tristique sed massa id.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/fotter.php'; ?>