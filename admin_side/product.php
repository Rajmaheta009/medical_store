<?php include 'include/header.php'; ?>
<div class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Search by name" aria-label="Search by name" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addEditProductModal">
                    <i class="fas fa-plus-circle"></i> Add Product
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row">
            <?php
            include '../database/collaction.php';
            $products = $product_collection->find();
            foreach ($products as $product) { ?>
                <div class="card col-md-3" style="background-color:#333; margin-bottom: 20px; margin-left:65px;">
                    <div class="image-wrapper">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body" style="margin-top: -60px;">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <h6 class="text-center md-3">$<?php echo $product['price']; ?></h6>
                        <button data-id="<?php echo $product['_id']; ?>" class="btn btn-primary edit-product-btn" data-bs-toggle="modal" data-bs-target="#addEditProductModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger ms-3 delete-product-btn" onclick="confirmDelete('<?php echo $product['_id']; ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Modal for Adding/Editing Product -->
        <div class="modal fade" id="addEditProductModal" tabindex="-1" aria-labelledby="addEditProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditProductModalLabel" style="color:#333;">Product Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" action="crud_code/product_crud.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="productId" name="product_id">
                            <input type="hidden" name="action" id="action" value="add">
                            <div class="mb-3">
                                <label for="productImage" class="form-label" style="color:#333;">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    <span id="uploadIcon" onclick="triggerFileInput()" style="cursor: pointer; font-size: 24px; display: inline-block; margin-top: 10px;">
                                        <i class="fas fa-plus-circle" style="color: black; padding:40px; border-radius:2px; border:dotted"></i>
                                    </span>
                                    <img id="imagePreview" class="img-thumbnail" src="#" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="productName" class="form-label" style="color:#333;">Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" required>
                                </div>
                                <div class="col">
                                    <label for="productType" class="form-label" style="color:#333;">Type</label>
                                    <select class="form-select" id="productType" name="productType" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="tablet">Tablet</option>
                                        <option value="syrup">Syrup</option>
                                        <option value="tube">Tube</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="productPrice" class="form-label" style="color:#333;">Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                                </div>
                                <div class="col">
                                    <label for="productPower" class="form-label" style="color:#333;">Power</label>
                                    <input type="text" class="form-control" id="productPower" name="productPower" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productPharmacy" class="form-label" style="color:#333;">Pharmacy</label>
                                <select class="form-select" id="productPharmacy" name="productPharmacy" required>
                                    <option value="" disabled selected>Select pharmacy</option>
                                    <option value="pharmacy1">Pharmacy 1</option>
                                    <option value="pharmacy2">Pharmacy 2</option>
                                    <option value="pharmacy3">Pharmacy 3</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="editProductGramMl" class="form-label" style="color:#333;">Gram/ML</label>
                                    <input type="text" class="form-control" id="editProductGramMl" name="editProductGramMl" required>
                                </div>
                                <div class="col">
                                    <label for="editProductSellingPrice" class="form-label" style="color:#333;">Selling Price</label>
                                    <input type="number" class="form-control" id="editProductSellingPrice" name="editProductSellingPrice" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label" style="color:#333;">Description</label>
                                <input type="text" class="form-control" id="productDescription" name="productDescription" required>
                            </div>

                            <button type="submit" class="btn btn-primary" style="margin-top:7px;" id="submitButton">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
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
    </main>
</div>

<script>
function showToast(message) {
    var toastEl = document.getElementById('liveToast');
    var toastBody = toastEl.querySelector('.toast-body');
    toastBody.innerText = message;

    var toast = new bootstrap.Toast(toastEl, {
        delay: 5000 // Hide after 5 seconds
    });

    // Show the toast after 2 seconds (2000 milliseconds)
    setTimeout(function() {
        toast.show();
    }, 2000);
}

// URL parameter parsing function
function getParameterByName(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

document.addEventListener('DOMContentLoaded', function() {
    // Check for success or error messages
    const successMessage = getParameterByName('success');
    if (successMessage) {
        showToast(successMessage);
    }
    
    const errorMessage = getParameterByName('error');
    if (errorMessage) {
        showToast(errorMessage);
    }

    // Handle edit product button click
    document.querySelectorAll('.edit-product-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            // Fetch product data from server and populate form (AJAX call)
            fetch(`crud_code/product_crud.php?action=get&product_id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('productId').value = data._id;
                    document.getElementById('productName').value = data.name;
                    document.getElementById('productType').value = data.type;
                    document.getElementById('productPrice').value = data.price;
                    document.getElementById('productDescription').value = data.description;
                    document.getElementById('action').value = 'edit';
                    document.getElementById('addEditProductModalLabel').innerText = 'Edit Product';
                    
                    // Set image preview if available
                    if (data.image) {
                        document.getElementById('imagePreview').src = data.image;
                        document.getElementById('imagePreview').style.display = 'block';
                    } else {
                        document.getElementById('imagePreview').style.display = 'none';
                    }
                });
        });
    });

    // Handle delete product button click
    document.querySelectorAll('.delete-product-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this product?')) {
                fetch(`crud_code/product_crud.php?action=delete&product_id=${productId}`, {
                    method: 'POST'
                }).then(response => {
                    if (response.ok) {
                        // Reload page or remove product from list
                        location.reload();
                    } else {
                        alert('Failed to delete product.');
                    }
                });
            }
        });
    });

    // Image preview function
    document.getElementById('productImage').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Trigger file input click
    document.getElementById('uploadIcon').addEventListener('click', function() {
        document.getElementById('productImage').click();
    });
});
</script>

<?php include 'include/fotter.php'; ?>
