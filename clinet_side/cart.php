<?php include 'include/header.php' ?>
<div class="p_header text-center" style="justify-content:center !important;">
    <h1>BASKET</h1>
</div>
<div class="container product-page my-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>SS
                <th scope="col">Image</th>
                <th scope="col">product_Name</th>
                <th scope="col">QTY</th>
                <th scope="col">Price</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <th><img src="assets/image/p_image.jpg" alt="product name"></th>
                <th>product_name</th>
                <th>product_quntity</th>
                <th>product_price</th>
                <th><i class="bi bi-x"></i></th>
            </tr>
        </tbody>
    </table>
    <div class="total_amount">
        <br><br>
        <h5 class="text-end">TOTAL AMOUNT --</h5>
    </div>
    <div class="update-btn text-end">
        <button>Update Bascket <i class="bi bi-arrow-repeat"></i></button>
    </div>
    <div class="checkout-btn text-end">
        <button>Check out <i class="bi bi-chevron-right"></i></button>
    </div>
</div>
<?php include 'include/fotter.php' ?> 