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
    <div class="descri">
        <button class="des" id="toggleButton"><strong>Description</strong></button>
        <p class="des_pragraf visible" id="myParagraph">
            Maecenas iaculis mauris lacus, nec bibendum tellus maximus non. Proin eget dictum eros, sed viverra diam. Praesent eu rhoncus eros. In hac habitasse platea dictumst. Curabitur sagittis tristique odio eget pharetra. Aenean cursus congue est non dignissim. Ut mattis augue eu purus tristique, vitae fermentum libero sagittis. Etiam euismod magna neque, suscipit lobortis augue porta non. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque id ullamcorper ex. Etiam vestibulum felis at leo sodales aliquam. Donec risus nisi, ornare ut nisi non, vulputate dapibus turpis. Vestibulum non rhoncus lacus.<br>
            Donec auctor sapien vel ornare efficitur.<br>
            Aliquam pellentesque neque sed tortor faucibus, a ullamcorper justo tempor.<br>
            Vivamus pretium urna vitae interdum mattis.<br>
            Sed pretium leo eget est aliquam, sed aliquam ligula rhoncus.<br>
            Nullam sed risus fringilla, porta libero eu, ultrices nulla.<br>
            Proin id nisl semper, elementum lacus vel, egestas nunc. Praesent id libero lacinia, tincidunt sapien et, ullamcorper mi. Aliquam auctor luctus ex eget tincidunt. Donec maximus bibendum lorem eget cursus. Suspendisse vulputate fringilla metus eget maximus. Integer consequat arcu dolor, mollis mollis tellus auctor a. Etiam in quam lacus. Donec odio turpis, venenatis mollis bibendum quis, sodales vitae nisi. Cras nec nisi elementum felis vulputate rutrum.<br>
        </p>
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
<?php include 'include/fotter.php' ?>