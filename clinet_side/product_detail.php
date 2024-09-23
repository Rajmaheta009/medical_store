<?php include 'include/header.php' ?>
<div class="container product-page my-5">
    <div class="card mb-3" style="border:0; bottom:20px;">
        <div class="row g-0">
            <div class="col-md-4 text-center">
                <img src="assets/image/p_image.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8 product-de text-center">
                <div class="w-70">
                    <h1>Product_name</h1>
                    <h6>price</h6>
                    <h6>Category</h6>
                    <div class="product-count w-25 m-auto">
                        <label for="size">Quantity</label>
                        <form action="#" class="d-flex" style="padding: 0 0 15px 15px;">
                            <div class="qtyminus" onclick="changeQuantity(-1)">-</div>
                            <input type="text" id="quantity" name="quantity" value="1" class="qty" readonly>
                            <div class="qtyplus" onclick="changeQuantity(1)">+</div>
                        </form>
                    </div>
                    <button class="button" onclick="cart()"><strong>Add To Cart</strong></button>
                </div>
            </div>
        </div>
    </div>
    <h4>Related Product</h4>
    <div class="row row-col-md-3 g-4 py-5">
        <div class="owl-carousel">
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card1">
                    <div class="image">
                        <img src="assets/image/p_image.jpg" alt="Product Image">
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="description">
                        <h6>medi_name</h6>
                        <h6>medi_type</h6>
                        <h6>medi_price</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeQuantity(change) {
        var qtyInput = document.getElementById('quantity');
        var currentQty = parseInt(qtyInput.value);

        // Ensure the quantity doesn't go below 1
        if (currentQty + change >= 1) {
            qtyInput.value = currentQty + change;
        }
    }

    function cart() {
        var qty = document.getElementById('quantity').value;
        alert("You have added " + qty + " items to your cart.");
        // Add additional logic to add the item to the cart here
    }
</script>
<?php include 'include/fotter.php' ?>