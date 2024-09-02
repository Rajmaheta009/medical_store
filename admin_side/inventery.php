<?php include 'include/header.php';?>
<!-- Main Content -->
<main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Inventory </h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-user-plus"></i> Add Product Quantity
                    </button>
                </div>
            </div>

            <!-- Example Product Card -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Selling Quantity</th>
                        <th scope="col">Available Quantity</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data Row -->
                    <tr>
                        <th scope="row">1</th>
                        <th scope="row">Product 1</th>
                        <td>$10.00</td>
                        <td>$15.00</td>
                        <td>10</td>
                        <td class="text-success">5</td>
                        <td class="text-danger">4</td>
                        <td>28/12/2024</td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger delete" type="button" data-bs-target="#deleteProductModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

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

    <?php include 'include/fotter.php';?>