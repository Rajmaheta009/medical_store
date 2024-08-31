<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">
    
</head>
<body>
    <?php include 'navigationbar.php'?>
    <button id="darkModeToggle" class="btn btn-secondary dark-mode-toggle" style="justify-content: end; margin-left:95%; margin-top:18px;">
        <i class="fas fa-moon"></i>
    </button>
            <!-- Modal for Adding Product -->
            <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
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
            <!-- Modal for Deleting Product -->
            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
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
            <!-- user form -->
        
        <!-- inventery form -->
        <!-- Modal for Adding Product -->
        <div class="modal fade" id="add_inventery" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel" style="color:#333;">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="row">
                                    <div class="col">
                                        <label for="productPharmacy" class="form-label" style="color:#333;">Product Name</label>
                                        <select class="form-select" id="productPharmacy" required>
                                            <option value="" disabled selected>Select Product</option>
                                            <option value="pharmacy1">Product 1</option>
                                            <option value="pharmacy2">Product 2</option>
                                            <option value="pharmacy3">Product 3</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="productQuantity" class="form-label" style="color:#333;">Quantity</label>
                                        <input type="number" class="form-control" id="productQuantity" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="productExpiry" class="form-label" style="color:#333;">EXP Date</label>
                                        <input type="date" class="form-control" id="productExpiry" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top:7px;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

