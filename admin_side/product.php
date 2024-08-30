<?php include 'header.php';?>
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
            <div class="card" style="width: 18rem;">
                <div class="image-wrapper">
                    <img src="../requrment/project_logo_medi.png" width="100" height="20">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="card-text">Product Details</p>
                    <h6 class="text-end me-3">$Price</h6>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal" style="margin-right:0px;">
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
                            <h5 class="modal-title" id="addProductModalLabel" style="color:#333;">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="mb-3">
                                <label for="productImage" class="form-label" style="color:#333;">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <img id="imagePreview" class="img-thumbnail" src="#" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px;">
                                    <input type="file" class="form-control" id="productImage" accept="image/*" onchange="previewImage(event)" style="margin-top: 10px;">
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="productPrice" class="form-label" style="color:#333;">Name</label>
                                        <input type="text" class="form-control" placeholder= aria-label="First name">
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

            <!-- Modal for Editing Product -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <for<form>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Image Upload</label>
                                <div class="image-upload-wrapper">
                                    <img id="imagePreview" class="img-thumbnail" src="#" alt="Image Preview" style="display:none; width: 300px; height: 200px; object-fit: cover; border-radius: 10px;">
                                    <input type="file" class="form-control" id="productImage" accept="image/*" onchange="previewImage(event)" style="margin-top: 10px;">
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="productPrice" class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="Name" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="productType" class="form-label">Type</label>
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
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" required>
                                    </div>
                                <div class="col">
                                    <label for="productPower" class="form-label">Power</label>
                                    <input type="text" class="form-control" id="productPower" required>
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productPharmacy" class="form-label">Pharmacy</label>
                                    <select class="form-select" id="productPharmacy" required>
                                        <option value="" disabled selected>Select pharmacy</option>
                                        <option value="pharmacy1">Pharmacy 1</option>
                                        <option value="pharmacy2">Pharmacy 2</option>
                                        <option value="pharmacy3">Pharmacy 3</option>
                                    </select>
                                </div>
                                <div class="row">   
                                    <div class="col">
                                        <label for="editProductGramMl" class="form-label">Gram/ML</label>
                                        <input type="text" class="form-control" id="editProductGramMl" required>
                                    </div>
                                    <div class="col">
                                        <label for="editProductSellingPrice" class="form-label">Selling Price</label>
                                        <input type="number" class="form-control" id="editProductSellingPrice" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productGramMl" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="productGramMl" required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top:7px;">Submit</button>
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
                            <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this product?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include 'fotter.php';?>