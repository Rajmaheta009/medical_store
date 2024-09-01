<?php include 'include/header.php';?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-user-plus"></i> Add Product
                    </button>
                </div>
            </div>

            <!-- Example Product Card -->
            <div class="card" style="background-color:#333;">
                <div class="image-wrapper">
                    <img src="../requrment/Screenshot 2024-07-17 161525.png" width="100" height="20">
                </div>
                <div class="card-body" style="margin-top:-19px;">
                    <h5 class="card-title">Product Name</h5>
                    <p class="card-text">Product Details</p>
                    <h6 class="text-center md-3">$Price</h6>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal" style="margin-right:0px;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>

            <!-- Modal for Adding Product -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel" style="color:#333;">Product form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="mb-3">
                                <label for="productImage" class="form-label" style="color:#333;">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <!-- Hidden file input -->
                                    <input type="file" class="form-control" id="productImage" accept="image/*" onchange="previewImage(event)" style="display:none;">

                                    <!-- Plus icon to trigger file input -->
                                    <span id="uploadIcon" onclick="triggerFileInput()" style="cursor: pointer; font-size: 24px; display: inline-block; margin-top: 10px;">
                                        <i class="fas fa-plus-circle" style="color: black; padding:40px; border-radius:2px; border:dotted"></i> <!-- Adjusted icon -->
                                    </span>

                                    <!-- Image preview container -->
                                    <img id="imagePreview" class="img-thumbnail" src="#" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px; margin-top: 10px;">
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="productPrice" class="form-label" style="color:#333;">Name</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="productType" class="form-label" style="color:#333;">Type</label>
                                        <select class="form-select" id="productType" required>
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
                                    <input type="number" class="form-control" id="productPrice" required>
                                    </div>
                                <div class="col">
                                    <label for="productPower" class="form-label" style="color:#333;">Power</label>
                                    <input type="text" class="form-control" id="productPower" required>
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productPharmacy" class="form-label" style="color:#333;">Pharmacy</label>
                                    <select class="form-select" id="productPharmacy" required>
                                        <option value="" disabled selected>Select pharmacy</option>
                                        <option value="pharmacy1">Pharmacy 1</option>
                                        <option value="pharmacy2">Pharmacy 2</option>
                                        <option value="pharmacy3">Pharmacy 3</option>
                                    </select>
                                </div>
                                <div class="row">   
                                    <div class="col">
                                        <label for="editProductGramMl" class="form-label" style="color:#333;">Gram/ML</label>
                                        <input type="text" class="form-control" id="editProductGramMl" required>
                                    </div>
                                    <div class="col">
                                        <label for="editProductSellingPrice" class="form-label" style="color:#333;">Selling Price</label>
                                        <input type="number" class="form-control" id="editProductSellingPrice" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productGramMl" class="form-label" style="color:#333;">Description</label>
                                    <input type="text" class="form-control" id="productGramMl" required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top:7px;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
            // Get the image preview element
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block'; // Show the image preview

            // Hide the upload icon after the image is uploaded
            var uploadIcon = document.getElementById('uploadIcon');
            uploadIcon.style.display = 'none';
        };

        // Check if a file is selected
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]); // Read the file and trigger the 'onload'
        }
    }
</script>

    <?php include 'include/fotter.php';?>