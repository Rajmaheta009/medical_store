<?php include 'include/header.php'; ?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inventory</h1>
        <div class="input-group mb-3 w-50">
            <input type="text" class="form-control" placeholder="Search by product name" aria-label="Search by product name" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                <i class="fas fa-search"></i>
            </button>
            <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product Quantity
            </button>
        </div>
    </div>

    <!-- Product Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Selling Quantity</th>
                <th scope="col">Available Quantity</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../database/collaction.php';
            $datas = $inventery_collection->find();
            $counter = 1;
            foreach ($datas as $data) { ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['price']; ?></td>
                    <td><?php echo $data['s_price']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo $data['s_quantity']; ?></td>
                    <td><?php echo $data['A_quantity']; ?></td>
                    <td><?php echo $data['exp_Date']; ?></td>
                    <td>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                            data-id="<?php echo $data['_id']; ?>"
                            data-name="<?php echo $data['name']; ?>"
                            data-quantity="<?php echo $data['quantity']; ?>"
                            data-expiry-date="<?php echo $data['exp_Date']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal for Adding/Editing Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel" style="color:#333;">Product Inventory Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="inventery.php" method="POST">
                        <input type="hidden" id="productId" name="productId">
                        <div class="row">
                            <div class="col">
                                <label for="productName" class="form-label" style="color:#333;">Product Name</label>
                                <select class="form-select" id="productName" name="productName" required>
                                    <option value="" disabled selected>Select Product</option>
                                    <?php
                                    // Fetch all products from MongoDB collection
                                    $products = $product_collection->find(); // Assuming 'product_collection' is your products collection
                                    foreach ($products as $product) {
                                        echo '<option value="' . $product['name'] . '">' . $product['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="productQuantity" class="form-label" style="color:#333;">Quantity</label>
                                <input type="number" class="form-control" id="productQuantity" name="productQuantity" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="productExpiry" class="form-label" style="color:#333;">EXP Date</label>
                                <input type="date" class="form-control" id="productExpiry" name="productExpiry" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:7px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="toast-header" style="background-color:#333; color:aliceblue;">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background-color:#333; color:aliceblue;">
                <!-- Toast message will be set here -->
            </div>
        </div>
    </div>

    <script>
        function showToast(message) {
            var toastEl = document.getElementById('liveToast');
            var toastBody = toastEl.querySelector('.toast-body');
            toastBody.innerText = message;

            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        // URL parameter parsing function
        function getParameterByName(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const status = getParameterByName('status');
            const type = getParameterByName('type');

            if (status && type) {
                let message = '';

                if (status === 'success' && type === 'add') {
                    message = 'Product added successfully!';
                } else if (status === 'success' && type === 'edit') {
                    message = 'Product updated successfully!';
                } else if (status === 'failed' && type === 'edit') {
                    message = 'Failed to update product!';
                } else if (status === 'failed' && type === 'add') {
                    message = 'Failed to add product!';
                }

                // Show the toast with the respective message if it's not empty
                if (message) {
                    showToast(message);
                }
            }
        });

        // JavaScript to handle the Add/Edit Product Modal behavior
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-outline-primary');
            const addProductButton = document.getElementById('addProductBtn');
            const productIdInput = document.getElementById('productId');
            const productNameInput = document.getElementById('productName');
            const productQuantityInput = document.getElementById('productQuantity');
            const productExpiryInput = document.getElementById('productExpiry');

            // Clear form fields when Add Product button is clicked
            addProductButton.addEventListener('click', function() {
                productIdInput.value = ''; // Clear hidden Product ID
                productNameInput.value = ''; // Clear name field
                productQuantityInput.value = ''; // Clear quantity field
                productExpiryInput.value = ''; // Clear expiry date field
            });

            // Populate form when Edit button is clicked
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');
                    const productQuantity = this.getAttribute('data-quantity');
                    const productExpiryDate = this.getAttribute('data-expiry-date');

                    // Set the values in the modal inputs
                    productIdInput.value = productId;
                    productNameInput.value = productName;
                    productQuantityInput.value = productQuantity;
                    productExpiryInput.value = productExpiryDate;
                });
            });
        });

        function confirmDelete(productId) {
            if (confirm("Are you sure you want to delete this product?")) {
                // Redirect to delete PHP script with product ID
                window.location.href = `crud_code/product_delete.php?id=${productId}`;
            }
        }
    </script>
    <?php include 'include/fotter.php'; ?>
