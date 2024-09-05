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
                        <img src="<?php echo $product['image_id']; ?>" alt="<?php echo $product['name']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body" style="margin-top: -60px;">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <h6 class="text-center md-3">$<?php echo $product['price']; ?></h6>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                            data-id="<?php echo $product['_id']; ?>"
                            data-name="<?php echo $product['name']; ?>"
                            data-phone="<?php echo $product['type']; ?>"
                            data-price="<?php echo $product['price']; ?>"
                            data-power="<?php echo $product['power']; ?>"
                            data-pharmacy="<?php echo $product['pharmacy']; ?>"
                            data-gram_ml="<?php echo $product['gram_ml']; ?>"
                            data-selling_price="<?php echo $product['selling_price']; ?>"
                            data-description="<?php echo $product['description']; ?>"
                            data-image="<?php echo $product['image_id']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>

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
                                    <input type="text" class="form-control" id="productName" name="productname" required>
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
                                    <input type="number" class="form-control" id="productPrice" name="productprice" required>
                                </div>
                                <div class="col">
                                    <label for="productPower" class="form-label" style="color:#333;">Power</label>
                                    <input type="text" class="form-control" id="productPower" name="productpower" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productPharmacy" class="form-label" style="color:#333;">Pharmacy</label>
                                <select class="form-select" id="productPharmacy" name="productpharmacy" required>
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


<!-- Your content goes here -->

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

    document.addEventListener('DOMContentLoaded', (event) => {
        const status = getParameterByName('status');
        const type = getParameterByName('type');

        if (status && type) {
            let message = '';

            if (status === 'success' && type === 'add') {
                message = 'product added successfully!';
            } else if (status === 'success' && type === 'edit') {
                message = 'product updated successfully!';
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
</script>



<!-- JavaScript to handle the Add/Edit User Modal behavior -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-outline-primary');
        const addUserButton = document.getElementById('addUserBtn');
        const productIdInput = document.getElementById('product_id');
        const imageInput = document.getElementById('productImage');
        const nameInput = document.getElementById('productname');
        const typeInput = document.getElementById('productType');
        const priceInput = document.getElementById('productprice');
        const powerInput = document.getElementById('productpower');
        const pharmacyInput = document.getElementById('productpharmacy');
        const GramMlInput = document.getElementById('editProductGramMl');
        const SellingPriceInput = document.getElementById('editProductSellingPrice');
        const DescriptionInput = document.getElementById('productDescription');

        // Clear form fields when Add User button is clicked
        addUserButton.addEventListener('click', function() {
            editButtons = ''; // make all field are empty..
            addUserButton = ''; // make all field are empty..
            productIdInput = ''; // make all field are empty..
            imageInput = ''; // make all field are empty..
            nameInput = ''; // make all field are empty..
            typeInput = ''; // make all field are empty..
            priceInput = ''; // make all field are empty..
            powerInput = ''; // make all field are empty..
            pharmacyInput = ''; // make all field are empty..
            GramMlInput = ''; // make all field are empty..
            SellingPriceInput = ''; // make all field are empty..
            DescriptionInput = ''; // make all field are empty..
        });

        // Populate form when Edit button is clicked
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const image = this.getAttribute('data-image');
                const name = this.getAttribute('data-type');
                const price = this.getAttribute('data-price');
                const power = this.getAttribute('data-power');
                const pharmacy = this.getAttribute('data-pharmacy');
                const gram_ml = this.getAttribute('data-gram_ml');
                const selling_price = this.getAttribute('data-selling_price');
                const description = this.getAttribute('data-description');

                // Set the values in the modal inputs
                productIdInput = productId;
                imageInput = image;
                nameInput = name;
                typeInput = type;
                priceInput = price;
                powerInput = power;
                pharmacyInput = pharmacy;
                GramMlInput = gram_ml;
                SellingPriceInput = selling_price;
                DescriptionInput = description;
            });
        });
    });

    function confirmDelete(productId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Redirect to delete PHP script with user ID
            window.location.href = `crud_code/product_delte.php?id=${productId}`;
        }
    }

    function triggerFileInput() {
        document.getElementById('productImage').click();
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php include 'include/fotter.php'; ?>