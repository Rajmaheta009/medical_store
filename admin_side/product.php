<?php include 'include/header.php'; ?>

<main class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name" aria-label="Search by name" aria-describedby="button-addon2" onkeyup="filterProducts()">
                <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addEditProductModal">
                    <i class="fas fa-plus-circle"></i> Add Product
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row" id="productCart" style="margin-right: -70px; margin-left:100px;">
            <?php
            include '../database/collaction.php';
            $products = $product_collection->find()->toArray();
            $filter_product = array_filter($products, function ($product) {
                return $product['check'] == true && $product['delete'] == false;
            });
            foreach ($filter_product as $product) { ?>
                <div class="card col-md-3 mb-4 mx-3 product-card" data-name="<?php echo strtolower(htmlspecialchars($product['name'])); ?>" style="margin-top: 70px;">
                    <div class="image-wrapper">
                        <img src="assets/image/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="card-img-top">
                    </div>
                    <div class="card-body mt-n4" style="margin-top:-60px;">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <h6 class="text-center">$<?php echo number_format($product['price'], 2); ?></h6>
                        <!-- Edit and Delete Buttons -->
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addEditProductModal" data-id="<?php echo $product['_id']; ?>" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-image="<?php echo htmlspecialchars($product['image']); ?>" data-type="<?php echo htmlspecialchars($product['type']); ?>" data-price="<?php echo htmlspecialchars($product['price']); ?>" data-power="<?php echo htmlspecialchars($product['power']); ?>" data-pharmacy="<?php echo htmlspecialchars($product['pharmacy']); ?>" data-gram_ml="<?php echo htmlspecialchars($product['gram_ml']); ?>" data-selling_price="<?php echo htmlspecialchars($product['selling_price']); ?>" data-description="<?php echo htmlspecialchars($product['description']); ?>" data-check="<?php echo $product['check'] ? '1' : '0'; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" onclick="confirmDelete('<?php echo $product['_id']; ?>')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Modal for Adding/Editing Product -->
        <div class="modal fade" id="addEditProductModal" tabindex="-1" aria-labelledby="addEditProductModalLabel" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditProductModalLabel" style="color:black"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" action="crud_code/product_crud.php" method="post" enctype="multipart/form-data" style="color:#333">
                            <input type="hidden" id="productId" name="product_id">
                            <input type="hidden" name="action" id="action" value="add">
                            <!-- Image Upload Section -->
                            <div class="mb-3 text-center">
                                <label for="productImage" class="form-label">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    <span id="uploadIcon" onclick="triggerFileInput()" style="cursor: pointer; font-size: 24px; justify-content:center;">
                                        <i class="fas fa-plus-circle" style="color: black; padding:40px; border-radius:2px; border:dotted;"></i>
                                    </span>
                                    <img id="imagePreview" class="img-thumbnail" src="assets/image/<?php echo $product['image']; ?>" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px;">
                                    <img id="existingImage" class="img-thumbnail" src="assets/image/2121733.jpg" alt="Existing Image" style="width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px; display:none;">
                                </div>
                            </div>

                            <!-- Other Input Fields -->
                            <div class="row">
                                <div class="col">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="productName" name="productname" maxlength="100" pattern="[A-Za-z0-9\s]+" title="Only letters, numbers, and spaces are allowed" required>
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
                                    <input type="number" class="form-control" id="productPrice" name="productprice" step="0.01" min="0" required>
                                </div>
                                <div class="col">
                                    <label for="productPower" class="form-label">Power</label>
                                    <input type="text" class="form-control" id="productPower" name="productpower" maxlength="50" pattern="[A-Za-z0-9\s]+" title="Only letters, numbers, and spaces are allowed" required>
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
                                    <input type="text" class="form-control" id="editProductGramMl" name="editProductGramMl" pattern="\d+(\.\d{1,2})?" title="Only numbers or decimal values are allowed" required>
                                </div>
                                <div class="col">
                                    <label for="editProductSellingPrice" class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" id="editProductSellingPrice" name="editProductSellingPrice" step="0.01" min="0" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" name="productdescription" rows="3" maxlength="500" required></textarea>
                            </div>
                            <label class="form-label" for="productCheck">Check</label>
                            <select class="form-select" id="productCheck" name="productCheck" required>
                                <option value="1">Check</option>
                                <option value="0">Uncheck</option>
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteForm" action="crud_code/product_crud.php" method="post">
                            <input type="hidden" name="product_id" id="productIdToDelete">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</main>

<script>
    function confirmDelete(productId) {
        // Set the product ID to delete
        document.getElementById('productIdToDelete').value = productId;
    }

    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const existingImage = document.getElementById('existingImage');
        const uploadIcon = document.getElementById('uploadIcon');

        if (event.target.files.length > 0) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                existingImage.style.display = 'none';
                uploadIcon.style.display = 'none'; // Hide upload icon
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            existingImage.style.display = 'block';
            uploadIcon.style.display = 'block'; // Show upload icon
        }
    }

    function triggerFileInput() {
        document.getElementById('productImage').click();
    }

    // Function to handle adding/editing products and updating modal content
    document.getElementById('addEditProductModal').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const action = button.getAttribute('data-action'); // Extract info from data-* attributes

        const modalTitle = document.getElementById('addEditProductModalLabel');
        const productId = document.getElementById('productId');
        const productName = document.getElementById('productName');
        const productType = document.getElementById('productType');
        const productPrice = document.getElementById('productPrice');
        const productPower = document.getElementById('productPower');
        const productPharmacy = document.getElementById('productPharmacy');
        const editProductGramMl = document.getElementById('editProductGramMl');
        const editProductSellingPrice = document.getElementById('editProductSellingPrice');
        const productDescription = document.getElementById('productDescription');
        const productCheck = document.getElementById('productCheck');

        if (action === 'edit') {
            modalTitle.textContent = 'Edit Product';
            productId.value = button.getAttribute('data-id');
            productName.value = button.getAttribute('data-name');
            productType.value = button.getAttribute('data-type');
            productPrice.value = button.getAttribute('data-price');
            productPower.value = button.getAttribute('data-power');
            productPharmacy.value = button.getAttribute('data-pharmacy');
            editProductGramMl.value = button.getAttribute('data-gram_ml');
            editProductSellingPrice.value = button.getAttribute('data-selling_price');
            productDescription.value = button.getAttribute('data-description');
            productCheck.value = button.getAttribute('data-check');

            // Show existing image
            document.getElementById('existingImage').src = 'assets/image/' + button.getAttribute('data-image');
            document.getElementById('existingImage').style.display = 'block';
            document.getElementById('imagePreview').style.display = 'none';
        } else {
            modalTitle.textContent = 'Add Product';
            productId.value = '';
            productName.value = '';
            productType.value = '';
            productPrice.value = '';
            productPower.value = '';
            productPharmacy.value = '';
            editProductGramMl.value = '';
            editProductSellingPrice.value = '';
            productDescription.value = '';
            productCheck.value = '1'; // Default to checked
            document.getElementById('existingImage').style.display = 'none';
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Filter products by name
    function filterProducts() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            if (name.includes(filter)) {
                card.style.display = ''; // Show card
            } else {
                card.style.display = 'none'; // Hide card
            }
        });
    }
</script>

<?php include 'include/fotter.php'; ?>