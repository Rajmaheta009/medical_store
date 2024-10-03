<?php include 'include/header.php'; ?>
<div class="p_header text-center" style="justify-content:center !important;">
    <h1>BASKET</h1>
</div>

<div class="container product-page my-5">
    <?php
    session_start();

    // Check if the cart is empty
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<h5 class='text-center'>Your cart is empty!</h5>";
    } else {
    ?>
        <form action="update_cart.php" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_amount = 0;
                    $counter = 1;
                    foreach ($_SESSION['cart'] as $id => $product) {
                        $total_price = $product['price'] * $product['quantity'];
                        $total_amount += $total_price;
                    ?>
                        <tr>
                            <th><?php echo $counter++; ?></th>
                            <th><img src="../admin_side/assets/image/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 50px;"></th>
                            <th><?php echo htmlspecialchars($product['name']); ?></th>
                            <th>
                                <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $product['quantity']; ?>" min="1" style="width: 60px;">
                            </th>
                            <th>$<?php echo number_format($product['price'], 2); ?></th>
                            <th>$<?php echo number_format($total_price, 2); ?></th>
                            <th>
                                <a href="remove_from_cart.php?product_id=<?php echo $id; ?>" class="text-danger"><i class="bi bi-x"></i></a>
                            </th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Total Amount Section -->
            <div class="total_amount text-end my-4">
                <h5>Total Amount: $<?php echo number_format($total_amount, 2); ?></h5>
            </div>

            <!-- Buttons -->
            <div class="update-btn text-end">
                <button type="submit" class="btn btn-primary">Update Basket <i class="bi bi-arrow-repeat"></i></button>
            </div>
            <div class="checkout-btn text-end mt-3">
                <a href="checkout.php" class="btn btn-success">Check out <i class="bi bi-chevron-right"></i></a>
            </div>
        </form>
    <?php } ?>
</div>

<?php include 'include/fotter.php'; ?>