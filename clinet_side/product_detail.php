<?php
include 'include/header.php';

$productid = isset($_GET['id']) ? $_GET['id'] : null; // Get product ID from the URL

if ($productid) {
    include '../database/collaction.php';

    // Fetch the product details from MongoDB based on the ID
    $product = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productid)]);

    if ($product) {
?>
        <div class="container product-page my-5">
            <div class="card mb-3" style="border:0; bottom:20px;">
                <div class="row g-0">
                    <div class="col-md-4 text-center">
                        <img src="../admin_side/assets/image/<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid rounded-start" alt="Product Image">
                    </div>
                    <div class="col-md-8 product-de text-center">
                        <div class="w-70">
                            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                            <h6>$<?php echo number_format($product['selling_price'], 2); ?></h6>
                            <h6><?php echo htmlspecialchars($product['type']); ?></h6>
                            <div class="product-count w-25 m-auto">
                                <label for="size">Quantity</label>
                                <form action="#" class="d-flex" style="padding: 0 0 15px 15px;">
                                    <div class="qtyminus" onclick="changeQuantity(-1)" style="cursor:pointer;">-</div>
                                    <input type="text" id="quantity" name="quantity" value="1" class="qty" readonly>
                                    <div class="qtyplus" onclick="changeQuantity(1)"style="cursor:pointer;">+</div>
                                </form>
                            </div>
                            <a href="cart.php?id=<?php echo urlencode($product['_id']); ?>"><button class="button"><strong>Add To Cart</strong></button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="descri">
                <button class="des" id="toggleButton"><strong>Description</strong></button>
                <p class="des_pragraf visible" id="myParagraph">
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>
            </div>
        </div>
<?php
    } else {
        echo 'Product not found.';
    }
} else {
    echo 'No product ID provided.';
}
?>

<script>
    // Your existing JavaScript code
    function changeQuantity(change) {
        var qtyInput = document.getElementById('quantity');
        var currentQty = parseInt(qtyInput.value);

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