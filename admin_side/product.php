<?php include 'include/header.php'; ?>

<main class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name" aria-label="Search by name" aria-describedby="button-addon2">
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
            $products = $product_collection->find();
            foreach ($products as $product) { ?>
                <div class="card col-md-3 mb-4 mx-3" style="margin-top: 70px;">
                    <div class="image-wrapper">
                        <img src="assets/image/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="card-img-top">
                    </div>
                    <div class="card-body mt-n4" style="margin-top:-60px;">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <h6 class="text-center">$<?php echo number_format($product['price'], 2); ?></h6>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addEditProductModal"
                            data-id="<?php echo $product['_id']; ?>"
                            data-image="assets/image/<?php echo $product['image']; ?>"
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
                                    <img id="imagePreview" class="img-thumbnail" src="" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px;">
                                    <img id="existingImage" class="img-thumbnail" src="" alt="Existing Image" style="width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px; display:none;">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitProductBtn">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</main>

<!-- JavaScript for Image Preview -->
<script>
    function previewImage(event) {
        const image = document.getElementById('imagePreview');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            image.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }

    function triggerFileInput() {
        document.getElementById('productImage').click();
    }

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = `crud_code/product_crud.php?action=delete&id=${id}`;
        }
    }

    document.getElementById('searchInput').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.card');
        products.forEach(product => {
            const name = product.querySelector('.card-title').textContent.toLowerCase();
            if (name.includes(query)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    });

    document.getElementById('addProductBtn').addEventListener('click', function() {
        document.getElementById('productForm').reset();
        document.getElementById('productId').value = '';
        document.getElementById('action').value = 'add';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('existingImage').style.display = 'none';
        document.getElementById('addEditProductModalLabel').textContent = 'Add New Product';
    });

    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Form submission logic
        const formData = new FormData(this);
        fetch('crud_code/product_crud.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    });

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('addEditProductModal');
            const modalTitle = modal.querySelector('.modal-title');
            const productId = this.getAttribute('data-id');
            const image = this.getAttribute('data-image');
            const name = this.getAttribute('data-name');
            const type = this.getAttribute('data-type');
            const price = this.getAttribute('data-price');
            const power = this.getAttribute('data-power');
            const pharmacy = this.getAttribute('data-pharmacy');
            const gramMl = this.getAttribute('data-gram_ml');
            const sellingPrice = this.getAttribute('data-selling_price');
            const description = this.getAttribute('data-description');

            if (productId) {
                modalTitle.textContent = 'Edit Product';
                document.getElementById('productId').value = productId;
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('existingImage').style.display = 'block';
                document.getElementById('existingImage').src = image;
                document.getElementById('productName').value = name;
                document.getElementById('productType').value = type;
                document.getElementById('productPrice').value = price;
                document.getElementById('productPower').value = power;
                document.getElementById('productPharmacy').value = pharmacy;
                document.getElementById('editProductGramMl').value = gramMl;
                document.getElementById('editProductSellingPrice').value = sellingPrice;
                document.getElementById('productDescription').value = description;
                document.getElementById('action').value = 'edit';
            } else {
                modalTitle.textContent = 'Add New Product';
                document.getElementById('productForm').reset();
                document.getElementById('productId').value = '';
                document.getElementById('action').value = 'add';
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('existingImage').style.display = 'none';
            }
        });
    });
</script>

<?php include 'include/fotter.php'; ?>
