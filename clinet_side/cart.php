<?php include 'include/header.php'; ?>

<div class="p_header text-center" style="justify-content:center !important;">
    <h1>BASKET</h1>
</div>

<div class="container product-page my-5">
    <?php
    session_start();
    include '../database/collaction.php';

    // Initialize cart if it's not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Fetch product ID from URL if present
    $productid = isset($_GET['id']) ? $_GET['id'] : null;

    // If a product ID is provided, fetch product details
    if ($productid) {
        $product = $product_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productid)]);

        if ($product) {
            // Add the product to the session cart if not already added
            if (!isset($_SESSION['cart'][$productid])) {
                $_SESSION['cart'][$productid] = [
                    'id' => $productid,
                    'name' => $product['name'],
                    'price' => $product['selling_price'],
                    'image' => $product['image'],
                    'quantity' => 1 // Default quantity
                ];
            }
        } else {
            echo '<p class="text-danger">Product not found.</p>';
        }
    }

    // If the form was submitted to remove an item
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
        $productIdToRemove = $_POST['product_id'];

        // Remove the product from the session cart
        if (isset($_SESSION['cart'][$productIdToRemove])) {
            unset($_SESSION['cart'][$productIdToRemove]);
        }

        // Redirect back to the cart page after removal
        header('Location: cart.php');
        exit();
    }

    // Calculate total amount
    $totalAmount = 0;

    // Display the cart table with product details
    if (!empty($_SESSION['cart'])) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Price</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($_SESSION['cart'] as $item) {
                    $itemTotal = $item['price'] * $item['quantity'];
                    $totalAmount += $itemTotal;
                ?>
                    <tr>
                        <th><?php echo $counter++; ?></th>
                        <td>
                            <img src="../admin_side/assets/image/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="50">
                        </td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>
                            <form action="#" class="d-flex" style="padding: 0 0 15px 15px;">
                                <div class="qtyminus" onclick="changeQuantity('<?php echo $item['id']; ?>', -1)" style="cursor:pointer;">-</div>
                                <input type="text" id="quantity_<?php echo $item['id']; ?>" name="quantity" value="<?php echo $item['quantity']; ?>" class="qty" readonly>
                                <div class="qtyplus" onclick="changeQuantity('<?php echo $item['id']; ?>', 1)" style="cursor:pointer;">+</div>
                            </form>
                        </td>
                        <td id="price_<?php echo $item['id']; ?>">$<?php echo number_format($itemTotal, 2); ?></td>
                        <td>
                            <form action="#" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" style="border: none; background: none;">
                                    <i class="bi bi-x" style="cursor: pointer;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="total_amount">
            <h5 class="text-end">TOTAL AMOUNT: $<span id="totalAmount"><?php echo number_format($totalAmount, 2); ?></span></h5>
        </div>

        <div class="checkout-btn text-end">
            <button>Check Out <i class="bi bi-chevron-right"></i></button>
        </div>

    <?php
    } else {
        echo '<p>Your cart is empty.</p>';
    }
    ?>
</div>

<script>
    // JavaScript for updating quantity dynamically
    function changeQuantity(productId, change) {
        var qtyInput = document.getElementById('quantity_' + productId);
        var priceElement = document.getElementById('price_' + productId);
        var totalAmountElement = document.getElementById('totalAmount');

        var currentQty = parseInt(qtyInput.value);
        var price = parseFloat(priceElement.innerText.replace('$', '').replace(',', ''));

        // Update quantity and price display
        if (currentQty + change >= 1) {
            currentQty += change;
            qtyInput.value = currentQty;

            // Update the price display for the current item
            var itemTotalPrice = currentQty * price  / (currentQty - change); ;
            priceElement.innerText = '$' + itemTotalPrice.toFixed(2);

            // Recalculate total amount
            calculateTotalAmount();

            // Update the session via AJAX
            fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: currentQty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Failed to update cart.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function calculateTotalAmount() {
        var totalAmount = 0;
        var prices = document.querySelectorAll('[id^="price_"]');
        prices.forEach(priceElement => {
            var price = parseFloat(priceElement.innerText.replace('$', '').replace(',', ''));
            totalAmount += price;
        });
        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
    }
</script>

<?php include 'include/footer.php'; ?>