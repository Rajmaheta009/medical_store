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
        <div class="row" style="margin-right: -70px; margin-left:100px;">
            <?php
            include '../database/collaction.php';
            $products = $product_collection->find();
            foreach ($products as $product) { ?>
                <div class="card col-md-3 mb-4 mx-3" style="margin-top:70px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    <div class="image-wrapper">
                        <img src="get_image.php?image_id=<?php echo $product['image_id']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body mt-n4" style="margin-top:-60px;">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <h6 class="text-center">$<?php echo number_format($product['price'], 2); ?></h6>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addEditProductModal"
                            data-id="<?php echo $product['_id']; ?>"
                            data-image="<?php echo $product['image_id']; ?>"
                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                            data-type="<?php echo htmlspecialchars($product['type']); ?>"
                            data-price="<?php echo htmlspecialchars($product['price']); ?>"
                            data-power="<?php echo htmlspecialchars($product['power']); ?>"
                            data-pharmacy="<?php echo htmlspecialchars($product['pharmacy']); ?>"
                            data-gram_ml="<?php echo htmlspecialchars($product['gram_ml']); ?>"
                            data-selling_price="<?php echo htmlspecialchars($product['selling_price']); ?>"
                            data-description="<?php echo htmlspecialchars($product['description']); ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="confirmDelete('<?php echo $product['_id']; ?>')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Modal for Adding/Editing Product -->
        <div class="modal fade" id="addEditProductModal" tabindex="-1" aria-labelledby="addEditProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditProductModalLabel">Product Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" action="crud_code/product_crud.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="productId" name="product_id">
                            <input type="hidden" name="action" id="action" value="add">
                            <!-- Image Upload Section -->
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <!-- Hidden File Input -->
                                    <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    <span id="uploadIcon" onclick="triggerFileInput()" style="cursor: pointer; font-size: 24px; justify-content:center;">
                                        <i class="fas fa-plus-circle" style="color: black; padding:40px; border-radius:2px; border:dotted;"></i>
                                    </span>
                                    <!-- Image Preview -->
                                    <img id="imagePreview" class="img-thumbnail" src="" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px;">
                                    <!-- Existing Image Display -->
                                    <img id="existingImage" class="img-thumbnail" src="" alt="Existing Image" style="width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px; display:none;">
                                </div>
                            </div>

                            <!-- Other Input Fields -->
                            <div class="row">
                                <div class="col">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="productName" name="productname" required>
                                </div>
                                <div class="col">
                                    <label for="productType" class="form-label">Type</label>
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
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="productprice" step="0.01" required>
                                </div>
                                <div class="col">
                                    <label for="productPower" class="form-label">Power</label>
                                    <input type="text" class="form-control" id="productPower" name="productpower" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productPharmacy" class="form-label">Pharmacy</label>
                                <select class="form-select" id="productPharmacy" name="productpharmacy" required>
                                    <option value="" disabled selected>Select pharmacy</option>
                                    <option value="pharmacy1">Pharmacy 1</option>
                                    <option value="pharmacy2">Pharmacy 2</option>
                                    <option value="pharmacy3">Pharmacy 3</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="editProductGramMl" class="form-label">Gram/ML</label>
                                    <input type="text" class="form-control" id="editProductGramMl" name="editProductGramMl" required>
                                </div>
                                <div class="col">
                                    <label for="editProductSellingPrice" class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" id="editProductSellingPrice" name="editProductSellingPrice" step="0.01" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <!-- Toast message will be set here -->
        </div>
    </div>
</div>

<script>
    function showToast(message, type) {
        var toastEl = document.getElementById('liveToast');
        var toastBody = toastEl.querySelector('.toast-body');

        // Set the message
        toastBody.innerText = message;

        // Set background colors based on the type
        if (type === 'success') {
            toastBody.style.backgroundColor = '#d4edda'; // green
            toastBody.style.color = '#155724'; // dark green
        } else if (type === 'error') {
            toastBody.style.backgroundColor = '#f8d7da'; // red
            toastBody.style.color = '#721c24'; // dark red
        }

        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    function confirmDelete(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = `crud_code/product_delete.php?id=${productId}`;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var addProductBtn = document.getElementById('addProductBtn');
        var modalTitle = document.getElementById('addEditProductModalLabel');
        var form = document.getElementById('productForm');
        var submitButton = document.getElementById('submitButton');

        // Event listener for modal show
        var modalEl = document.getElementById('addEditProductModal');
        modalEl.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            // Extract data from button attributes and update form
            var productId = button.getAttribute('data-id');
            var productImage = button.getAttribute('data-image');
            var productName = button.getAttribute('data-name');
            var productType = button.getAttribute('data-type');
            var productPrice = button.getAttribute('data-price');
            var productPower = button.getAttribute('data-power');
            var productPharmacy = button.getAttribute('data-pharmacy');
            var productGramMl = button.getAttribute('data-gram_ml');
            var productSellingPrice = button.getAttribute('data-selling_price');
            var productDescription = button.getAttribute('data-description');

            // Fill form fields
            document.getElementById('productId').value = productId;
            document.getElementById('productName').value = productName;
            document.getElementById('productType').value = productType;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('productPower').value = productPower;
            document.getElementById('productPharmacy').value = productPharmacy;
            document.getElementById('editProductGramMl').value = productGramMl;
            document.getElementById('editProductSellingPrice').value = productSellingPrice;
            document.getElementById('productDescription').value = productDescription;

            // If image exists, show the existing image
            var existingImage = document.getElementById('existingImage');
            var imagePreview = document.getElementById('imagePreview');
            if (productImage) {
                existingImage.src = 'get_image.php?image_id=' + productImage;
                existingImage.style.display = 'block';
                imagePreview.style.display = 'none';
            } else {
                existingImage.style.display = 'none';
                imagePreview.style.display = 'none';
            }

            // Set the form action based on whether it's add or edit
            document.getElementById('action').value = productId ? 'edit' : 'add';
            modalTitle.innerText = productId ? 'Edit Product' : 'Add Product';
            submitButton.innerText = productId ? 'Update' : 'Add';
        });
    });

    function triggerFileInput() {
        document.getElementById('productImage').click();
    }

    function previewImage(event) {
        var input = event.target;
        var file = input.files[0];
        var preview = document.getElementById('imagePreview');

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                document.getElementById('existingImage').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?php include 'include/fotter.php'; ?>
