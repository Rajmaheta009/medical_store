<?php include 'include/header.php'; ?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inventory</h1>
        <div class="input-group mb-3 w-50">
            <!-- Search Input Field -->
            <input type="text" class="form-control" id="searchInput" placeholder="Search by product name" aria-label="Search by product name" oninput="filterTable()">
            <button class="btn btn-primary" type="button" id="addProductBtn" data-bs-toggle="modal" data-bs-target="#addProductModal">
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
            foreach ($datas as $data) {
                if ($data['check'] && !$data['delete']) {
                    $product = $product_collection->findOne(['_id' => $data['product_id']]);
                    if (!empty($product)) { ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <!-- Updated Product Table Row -->
                            <td class="product-name"><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $product['selling_price']; ?></td>
                            <td><?php echo $data['quantity']; ?></td>
                            <td><?php echo $data['selling_quantity']; ?></td>
                            <td><?php echo $data['quantity'] - $data['selling_quantity']; ?></td>
                            <td><?php echo $data['expiry_date']->toDateTime()->format('Y-m-d'); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                                    data-id="<?php echo $data['_id']; ?>"
                                    data-name="<?php echo $product['name']; ?>"
                                    data-quantity="<?php echo $data['quantity']; ?>"
                                    data-expiry-date="<?php echo $data['expiry_date']->toDateTime()->format('Y-m-d'); ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <!-- Delete Button -->
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                    data-id="<?php echo $data['_id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </td>
                        </tr>
            <?php } else {
                        echo '<tr><td colspan="9">Product details not available</td></tr>';
                    }
                }
            } ?>
        </tbody>
    </table>

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="color:#333">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color:#333">
                    <form action="crud_code/inventery_crud.php" method="POST" id="inventoryForm">
                        <input type="hidden" id="productId" name="productId">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <select class="form-select" id="productName" name="productName" required>
                                <option value="" selected>Select Product</option>
                                <?php
                                $products = $product_collection->find();
                                foreach ($products as $product) {
                                    echo '<option value="' . $product['name'] . '">' . $product['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="productQuantity" name="productQuantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="productExpiry" class="form-label">EXP Date</label>
                            <input type="date" class="form-control" id="productExpiry" name="productExpiry" required>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="check" name="check" checked>
                            <label class="form-check-label" for="check">Active</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="color: #333;">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Delete A Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: #333;">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Toast notification container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div class="toast-header bg-dark text-light">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-dark text-light">
            <!-- Toast message will be displayed here -->
        </div>
    </div>
</div>

<script>
    // Show toast notification
    function showToast(message, type) {
        var toastEl = document.getElementById('liveToast');
        var toastHeader = document.querySelector('.toast-header');
        var toastBody = document.querySelector('.toast-body');

        toastBody.innerText = message;

        if (type === 'success') {
            toastHeader.classList.replace('bg-danger', 'bg-success');
        } else {
            toastHeader.classList.replace('bg-success', 'bg-danger');
        }

        var toast = new bootstrap.Toast(toastEl, {
            delay: 5000
        });
        toast.show();
    }

    // Populate delete modal with product ID
    document.addEventListener('DOMContentLoaded', function() {
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let deleteProductId;

        deleteConfirmModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            deleteProductId = button.getAttribute('data-id');
        });

        confirmDeleteBtn.addEventListener('click', function() {
            if (deleteProductId) {
                // Create a hidden form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'crud_code/inventery_crud.php';

                // Create hidden input to pass the product ID and delete flag
                const productIdInput = document.createElement('input');
                productIdInput.type = 'hidden';
                productIdInput.name = 'deleteProductId';
                productIdInput.value = deleteProductId;

                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete';
                deleteInput.value = '1'; // Set delete flag to 1

                form.appendChild(productIdInput);
                form.appendChild(deleteInput);

                // Append form to body and submit
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    function filterTable() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toUpperCase();
        var table = document.getElementById('inventoryTableBody');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var td = rows[i].getElementsByClassName('product-name')[0];
            if (td) {
                var textValue = td.textContent || td.innerText;
                rows[i].style.display = textValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }
</script>
<?php include 'include/fotter.php'; ?>