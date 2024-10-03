<?php include 'include/header.php'; ?>
<div class="container product-page my-5">
    <div class="card mb-3" style="border:0; bottom:20px;">
        <div class="row g-0">
            <?php
            include '../database/collaction.php';

            if (isset($_GET['id'])) {
                $productId = $_GET['id'];
                // Fetch the product details from MongoDB based on the ID
                $product = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
                if ($product) { ?>
                    <div class="col-md-4 text-center">
                        <img src="../admin_side/assets/image/<?php echo $product['image']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8 product-de text-center">
                        <div class="w-70">
                            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                            <h6>$<?php echo number_format($product['price'], 2); ?></h6>
                            <h6><?php echo htmlspecialchars($product['type']); ?></h6>
                            <div class="product-count w-25 m-auto">
                                <label for="size">Quantity</label>
                                <form action="#" class="d-flex" style="padding: 0 0 15px 15px;">
                                    <div class="qtyminus" onclick="changeQuantity(-1)">-</div>
                                    <input type="text" id="quantity" name="quantity" value="1" class="qty" readonly>
                                    <div class="qtyplus" onclick="changeQuantity(1)">+</div>
                                </form>
                            </div>
                            <a href="cart.php"><button class="button" onclick="cart()"><strong>Add To Cart</strong></button></a>
                        </div>
                    </div>
            <?php } else {
                    echo 'Product not found.';
                }
            } else {
                echo 'No product ID provided.';
            }
            ?>
        </div>
    </div>
    <div class="descri">
        <button class="des" id="toggleButton"><strong>Description</strong></button>
        <p class="des_pragraf visible" id="myParagraph">
            <?php echo htmlspecialchars($product['description']); ?>
        </p>
    </div>
    <h4>Related Products</h4>
    <div class="row row-col-md-3 g-4 py-5">
        <div class="owl-carousel">
            <?php
            // Fetch related products if needed, similar to how you've done previously
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
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                        <a href="product_detail.php?id=<?php echo urlencode($product['_id']); ?>">
                            <div class="description">
                                <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                                <h6><?php echo htmlspecialchars($product['type']); ?></h6>
                                <h6>$<?php echo number_format($product['price'], 2); ?></h6>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    // Your existing JavaScript code
    function changeQuantity(change) {
        var qtyInput = document.getElementById('quantity');
        var currentQty = parseInt(qtyInput.value);

        // Ensure the quantity doesn't go below 1
        if (currentQty + change >= 1) {
            qtyInput.value = currentQty + change;
        }
    }
    const toggleButton = document.getElementById('toggleButton');
    const paragraph = document.getElementById('myParagraph');

    toggleButton.addEventListener('click', () => {
        if (paragraph.classList.contains('hidden')) {
            paragraph.classList.remove('hidden');
            paragraph.classList.add('visible');
        } else {
            paragraph.classList.remove('visible');
            paragraph.classList.add('hidden');
        }
    });
</script>
<?php include 'include/fotter.php'; ?>