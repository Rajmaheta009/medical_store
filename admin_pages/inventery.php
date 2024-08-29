<?php include 'headerfile.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma4f5lPjyX7Ujq5k5BzG9jZtme5V4jF94D5p3cN0Rm7yxbJ" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" integrity="sha512-..." crossorigin="anonymous">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        body.dark-mode .table thead th {
            background-color: #333;
        }
        body.dark-mode .table tbody tr:hover {
            background-color: #444;
        }
        body.dark-mode .btn {
            color:#ffffff;
            background-color:#333;

        }
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        /* Base card style */
        .card {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.125);
            filter: drop-shadow(0 30px 10px rgba(0, 0, 0, 0.15));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 350px;
            padding: 20px; /* Added padding for consistency */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        /* Card image style */
        .card img {
            background-position: center;
            height: 120px;
            width: 100%; /* Adjust to cover full width */
            border-radius: 8px; /* Slightly smaller radius for a better look */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Lighter border */
            object-fit: cover; /* Ensure image covers the container */
            margin-bottom: 15px; /* Space between image and text */
        }

        /* Dark mode styles */
        .dark-mode .card {
            background-color: #121212;
            border: 1px solid #444;
        }

        .dark-mode .card img {
            border: 1px solid #444;
        }

        /* Ensuring smooth transitions and consistent styling */
        .dark-mode .card img {
            border: 1px solid #444;
            filter: brightness(90%); /* Slightly adjust image brightness for dark mode */
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle" class="btn btn-secondary dark-mode-toggle" style="margin-top:-4px; margin-left: 125px;">
        <i class="fas fa-moon"></i> Dark Mode
    </button>

        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Inventory </h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                        <i class="fas fa-search"></i> Search
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
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" class="text-success">Selling Quantity</th>
                        <th scope="col" class="text-danger">Available Quantity</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data Row -->
                    <tr>
                        <th scope="row">Product 1</th>
                        <td>$10.00</td>
                        <td>$15.00</td>
                        <td>10</td>
                        <td class="text-success">5</td>
                        <td class="text-danger">4</td>
                        <td>28/12/2024</td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline-danger delete" type="button" data-bs-target="#deleteProductModal">
                                <i class="fas fa-trash"></i> Delete
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
        function previewImage(event) {
            const image = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.style.display = 'block';
                    image.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                image.style.display = 'none';
                image.src = '';
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

            // Apply saved theme on load
            if (currentTheme) {
                document.body.classList.add(currentTheme);
                if (currentTheme === 'dark-mode') {
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> Light Mode';
                }
            }

            // Toggle dark mode
            darkModeToggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');

                // Update button text
                if (document.body.classList.contains('dark-mode')) {
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> Light Mode';
                    localStorage.setItem('theme', 'dark-mode');
                } else {
                    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i> Dark Mode';
                    localStorage.setItem('theme', 'light-mode');
                }
            });
        });
    </script>
</body>
</html>
