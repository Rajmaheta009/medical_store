<?php include 'include/header.php'; ?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inventory</h1>
        <div class="input-group mb-3 w-50">
            <input type="text" class="form-control" id="searchInput" placeholder="Search by product name" aria-label="Search by product name" aria-describedby="button-addon2">
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
        <tbody id="inventoryTableBody">
            <?php
            include '../database/collaction.php';
            $datas = $inventery_collection->find()->toArray();
            $counter = 1;
            $filter_inventery = array_filter($datas, function ($data) {
                return $data['check'] == true && $data['delete'] == false;
            });
            foreach ($filter_inventery as $data) { ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php
                        $product = $product_collection->findOne(['_id' => $data['product_id']]);
                        echo $product ? $product['name'] : 'Unknown'; ?></td>
                    <td><?php echo $product ? $product['price'] : 'N/A'; ?></td>
                    <td><?php echo $product ? $product['selling_price'] : 'N/A'; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo $data['selling_quantity']; ?></td>
                    <td><?php echo $data['quantity'] - $data['selling_quantity']; ?></td>
                    <td><?php echo $data['expiry_date']->toDateTime()->format('Y-m-d'); ?></td>
                    <td>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                            data-id="<?php echo $data['_id']; ?>"
                            data-name="<?php echo $product ? $product['name'] : ''; ?>"
                            data-quantity="<?php echo $data['quantity']; ?>"
                            data-expiry-date="<?php echo $data['expiry_date']->toDateTime()->format('Y-m-d'); ?>"
                            data-check="<?php echo $data['check']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                    <form action="crud_code/inventery_crud.php" method="POST">
                        <input type="hidden" id="productId" name="productId">
                        <div class="row">
                            <div class="col">
                                <label for="productName" class="form-label" style="color:#333;">Product Name</label>
                                <select class="form-select" id="productName" name="productName" required>
                                    <option value="" disabled selected>Select Product</option>
                                    <?php
                                    $products = $product_collection->find();
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
                            <div class="col justify-content-between">
                                <label for="productExpiry" class="form-label" style="color:#333;">EXP Date</label>
                                <input type="date" class="form-control" id="productExpiry" name="productExpiry" required>
                            </div>
                        </div>
                        <label class="form-label" style="color:#333;">Active</label>
                        <label class="ios-switch">
                            <input type="checkbox" checked name="check" value="1">
                            <span class="slider"></span>
                        </label>
                        <input type="hidden" name="delete" id="deleteField" value="false">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="margin-top: 7px; margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary" style="margin-top: 7px;" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel" style="color:#333;">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color: #333;">
                        Are you sure you want to delete this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">OK</button>
                    </div>
                </div>
            </div>
        </div></script>
    </div>
</main>
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
    function showToast(message, type) {
        var toastEl = document.getElementById('liveToast');
        var toastHeader = document.querySelector('.toast-header');
        var toastBody = document.querySelector('.toast-body');

        // Set the message
        toastBody.innerText = message;

        // Set background colors based on the type
        if (type === 'success') {
            toastHeader.style.backgroundColor = 'green'; // Success background color
            toastBody.style.backgroundColor = 'green';
        } else if (type === 'failed') {
            toastHeader.style.backgroundColor = 'red'; // Failed background color
            toastBody.style.backgroundColor = 'red';
        }

        // Show the toast
        var toast = new bootstrap.Toast(toastEl, {
            delay: 5000 // Hide after 5 seconds
        });

        // Show the toast after 2 seconds (2000 milliseconds)
        setTimeout(function() {
            toast.show();
        }, 2000);
    }

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

            if (message) {
                showToast(message, status);
            }
        }
    });

    // Add event listener for search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#inventoryTableBody tr');

        rows.forEach(row => {
            const productName = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            if (productName.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-outline-primary');
        const addProductButton = document.getElementById('addProductBtn');
        const productIdInput = document.getElementById('productId');
        const nameInput = document.getElementById('productName');
        const quantityInput = document.getElementById('productQuantity');
        const productExpiryInput = document.getElementById('productExpiry');
        const checkInput = document.getElementById('check');
        const modalTitle = document.getElementById('addProductModalLabel');

        // Clear form for adding a new product
        addProductButton.addEventListener('click', function() {

            modalTitle.innerText = 'Add Product Quantity'; // Set modal title for adding
            
            document.getElementById('deleteField').value = 'false';
            
            productIdInput.value = ''; // Clear hidden Product ID
            nameInput.value = ''; // Clear name field
            quantityInput.value = ''; // Clear quantity field
            productExpiryInput.value = ''; // Clear expiry date field
            checkInput.value = '1'; // Clear check field
        });
        
        // Fill the form for editing a product
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                
                document.getElementById('deleteField').value = 'true';
                
                const productId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const quantity = this.getAttribute('data-quantity');
                const productExpiry = this.getAttribute('data-expiry-date');
                const check = this.getAttribute('data-check');

                // Set the values in the modal inputs
                modalTitle.innerText = 'Edit Product Quantity'; // Set modal title for editing
                productIdInput.value = productId;
                nameInput.value = name;
                quantityInput.value = quantity;
                productExpiryInput.value = productExpiry;
                checkInput.value = check;
            });
        });
    });

    function confirmDelete(productId) {
        document.getElementById('deleteField').value = "true";
        window.location.href=window.location.href;
    }
</script>

<?php include 'include/fotter.php'; ?>