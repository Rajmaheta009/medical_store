<?php include 'include/header.php'; ?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="input-group mb-3 w-50">
            <input type="text" class="form-control" placeholder="Search by name" aria-label="Search by name" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                <i class="fas fa-search"></i>
            </button>
            <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" onclick="openAddProductModal()">
                <i class="fas fa-plus-circle"></i> Add Product
            </button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../database/collaction.php';
            $products = $product_collection->find();
            $count = 0; // Initialize a counter for cards
            foreach ($products as $product) {
                echo '
                <div class="card col-md-3" style="background-color:#333; margin-bottom: 20px; margin-left:65px;">
                    <div class="image-wrapper">
                        <img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="card-img-top" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body" style="margin-top: -60px;">
                        <h5 class="card-title">' . $product['name'] . '</h5>
                        <p class="card-text">' . $product['description'] . '</p>
                        <h6 class="text-center md-3">$' . $product['price'] . '</h6>
                        <button data-id="' . $product['_id'] . '" class="btn btn-primary edit-product-btn" onclick="openAddProductModal(this.getAttribute(\'data-id\'))">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button data-id="' . $product['_id'] . '" class="btn btn-danger ms-3 delete-product-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>';

                $count++;
            }
            ?>
        </div> <!-- End of the last row -->
    </div> <!-- End of container -->
    <!-- Modal for Adding/Edit Product -->
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

    <!-- Modal for Deleting Product -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Existing code -->
<script>
    // Function to trigger the hidden file input when the plus icon is clicked
    function triggerFileInput() {
        document.getElementById('productImage').click();
    }

    // Function to handle image preview and hide the plus icon
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';

            var uploadIcon = document.getElementById('uploadIcon');
            uploadIcon.style.display = 'none';
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    function openAddProductModal(productId = null) {
        if (productId) {
            // Fetch product details for editing
            fetch(`crud_code/get_product.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById('productId').value = data._id;
                    document.getElementById('productName').value = data.name;
                    document.getElementById('productType').value = data.type;
                    document.getElementById('productPrice').value = data.price;
                    document.getElementById('productPower').value = data.power;
                    document.getElementById('productPharmacy').value = data.pharmacy;
                    document.getElementById('editProductGramMl').value = data.gramMl;
                    document.getElementById('editProductSellingPrice').value = data.sellingPrice;
                    document.getElementById('productDescription').value = data.description;

                    if (data.image) {
                        var imagePreview = document.getElementById('imagePreview');
                        imagePreview.src = data.image;
                        imagePreview.style.display = 'block';
                        document.getElementById('uploadIcon').style.display = 'none';
                    }

                    document.getElementById('action').value = 'edit';
                    document.getElementById('submitButton').innerText = 'Save Changes';

                    var addEditModal = new bootstrap.Modal(document.getElementById('addEditProductModal'));
                    addEditModal.show();
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                    alert('Error fetching product details. Please try again.');
                });
        } else {
            document.getElementById('action').value = 'add';
            document.getElementById('submitButton').innerText = 'Add Product';
            document.getElementById('productForm').reset();
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('uploadIcon').style.display = 'inline-block';

            var addEditModal = new bootstrap.Modal(document.getElementById('addEditProductModal'));
            addEditModal.show();
        }
    }

    // Function to delete product
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-product-btn')) {
            const productId = e.target.getAttribute('data-id');
            document.getElementById('confirmDeleteButton').setAttribute('data-id', productId);
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteProductModal'));
            deleteModal.show();
        }
    });

    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        fetch('crud_code/delete_product.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'product_id': productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product deleted successfully!');
                    location.reload(); // Refresh the page to reflect the changes
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error deleting product:', error);
                alert('Error deleting product. Please try again.');
            });
    });
</script>
<?php include 'include/fotter.php'; ?>