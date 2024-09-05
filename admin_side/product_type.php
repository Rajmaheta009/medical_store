<style>
    select.form-select option {
        color: #333;
        /* Set color for the options */
    }
</style>
<?php include 'include/header.php'; ?>
<div class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products Types </h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:90px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-user-plus"></i> Add Product
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product_type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/collaction.php';
                $datas = $product_type_collection->find();
                $counter = 1;
                foreach ($datas as $data) {
                    $statusText = $data['status'] ? 'Active' : 'Inactive'; // Convert boolean to text
                    $statusClass = $data['status'] ? 'text-success' : 'text-danger'; // Apply appropriate class
                ?>
                <tr>
                        <td><?php echo $counter++ ?></td>
                        <td><?php echo $data['type']; ?></td>
                        <td class="<?php echo $statusClass; ?>">
                            <?php echo $statusText; ?>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                                data-id="<?php echo $data['_id']; ?>"
                                data-type="<?php echo $data['type']; ?>"
                                data-status="<?php echo $data['status'] ? '1' : '0'; ?>"> <!-- Use '1' or '0' for status -->
                                <i class="fas fa-edit"></i>
                            </button>

                            <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Modal for Adding User -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">product form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_code/product_Type_crud.php" method="POST">
                        <input type="hidden" id="product_typeId" name="product_typeId">
                            <div class="row">
                                <label for="type" class="form-label" style="color:#333;">Product Type</label>
                                <select id="type" name="type" class="form-select" required>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Syrum">Syram</option>
                                    <option value="Tube">Tube</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="status" style="color:#333;">Select Status:</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">In-Active</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000"> <!-- Auto hide after 5 seconds -->
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

        var toast = new bootstrap.Toast(toastEl, {
            delay: 5000 // Hide after 5 seconds
        });

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
                showToast(message);
            }
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-outline-primary');
        const addProductButton = document.getElementById('addProductBtn');
        const product_typeIdInput = document.getElementById('product_typeId');
        const typeInput = document.getElementById('type');
        const statusInput = document.getElementById('status');

        // Clear form for adding a new product
        addProductButton.addEventListener('click', function() {
            product_typeIdInput.value = ''; // Clear hidden Pharmacy ID
            typeInput.value = ''; // Clear name field
            statusInput.value = ''; // Clear status field
        });

        // Fill the form for editing a product
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const product_typeId = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');
                const status = this.getAttribute('data-status');

                // Set the values in the modal inputs
                product_typeIdInput.value = product_typeId;
                typeInput.value = type;
                statusInput.value = status;
            });
        });
    });

    function confirmDelete(product_typeId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = `crud_code/product_type_delete.php?id=${product_typeId}`;
        }
    }
</script>
<?php include 'include/fotter.php'; ?>