<?php include 'headerfile.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma4f5lPjyX7Ujq5k5BzG9jZtme5V4jF94D5p3cN0Rm7yxbJ" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" integrity="sha512-..." crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-left:6px" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-user-plus"></i> Add Product
                    </button>
                </div>
            </div>

            <!-- Example Product Card -->
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <img src="../requrment/project_logo_medi.png" class="card-img-top" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="card-text">Product Details</p>
                    <h6 class="text-end me-3">$Price</h6>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal" style="margin-right:70px;">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="#" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>

            <!-- Modal for Adding Product -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="productName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productType" class="form-label">Type</label>
                                    <select class="form-select" id="productType" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="tablet">Tablet</option>
                                        <option value="syrup">Syrup</option>
                                        <option value="tube">Tube</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Image Upload</label>
                                    <input type="file" class="form-control" id="productImage" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productPower" class="form-label">Power</label>
                                    <input type="text" class="form-control" id="productPower" required>
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
                                <div class="mb-3">
                                    <label for="productGramMl" class="form-label">Gram/ML</label>
                                    <input type="text" class="form-control" id="productGramMl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productSellingPrice" class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" id="productSellingPrice" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                            <form>
                                <div class="mb-3">
                                    <label for="editProductName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="editProductName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductType" class="form-label">Type</label>
                                    <select class="form-select" id="editProductType" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="tablet">Tablet</option>
                                        <option value="syrup">Syrup</option>
                                        <option value="tube">Tube</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductImage" class="form-label">Image Upload</label>
                                    <input type="file" class="form-control" id="editProductImage" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="editProductPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="editProductPrice" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductPower" class="form-label">Power</label>
                                    <input type="text" class="form-control" id="editProductPower" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductPharmacy" class="form-label">Pharmacy</label>
                                    <select class="form-select" id="editProductPharmacy" required>
                                        <option value="" disabled selected>Select pharmacy</option>
                                        <option value="pharmacy1">Pharmacy 1</option>
                                        <option value="pharmacy2">Pharmacy 2</option>
                                        <option value="pharmacy3">Pharmacy 3</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductGramMl" class="form-label">Gram/ML</label>
                                    <input type="text" class="form-control" id="editProductGramMl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editProductSellingPrice" class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" id="editProductSellingPrice" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEmeIV1m8gOnjK5la4aLHEkThD91D/ePb3qu5RcnPjkp6dF+Z2xjK3M13uoDIWdpE" crossorigin="anonymous"></script>

    <script>
        // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });

        // Handle Delete Confirmation
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.addEventListener('click', () => {
            // Add your deletion logic here
            alert('Product deleted.');
        });
    </script>
</body>
</html>
