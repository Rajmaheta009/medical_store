<?php include 'headerfile.PHP' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Store User Page</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body{
            background-color: gray;
        }
        .modal-content {
            border-radius: 0.5rem;
        }
        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }
        .modal-body {
            padding: 2rem;
        }
        .btn {
            margin-left: 6px;
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Users</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button class="btn btn-primary" type="button" id="addUserBtn" style="margin-left:6px">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                </div>
            </div>
            <!-- Table Section -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="h3">Users Details</h2>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="https://via.placeholder.com/50" alt="User 1" class="img-fluid rounded-circle"></td>
                        <td>Name_user</td>
                        <td>Customer</td>
                        <td>name@gmail.com</td>
                        <td>1234567890</td>
                        <td><span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="ADDRESS"><button class="btn btn-primary" type="button" disabled>ADDRESS</button></span></td>
                        <td>
                            <button class="btn btn-primary edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                data-id="1" data-name="Name_user" data-type="Customer" data-email="name@gmail.com" data-phone="1234567890" data-address="Address">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger delete-btn" type="button" data-id="1">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <!-- Repeat rows as necessary -->
                </tbody>
            </table>
        </main>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="mb-3">
                            <label for="addUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserType" class="form-label">Type</label>
                            <input type="text" class="form-control" id="addUserType" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addUserPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addUserAddress" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserType" class="form-label">Type</label>
                            <input type="text" class="form-control" id="editUserType" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editUserPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editUserAddress" required>
                        </div>
                        <input type="hidden" id="editUserId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Add Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <!-- JavaScript to handle modal data population and form submission -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const addUserBtn = document.getElementById('addUserBtn');
        let userIdToDelete = null; // Store user ID to delete

        // Handle "Edit User" button clicks
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Hide the "Add User" button when "Edit User" is clicked
                addUserBtn.style.display = 'none';
                
                // Get data attributes from the button
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userType = this.getAttribute('data-type');
                const userEmail = this.getAttribute('data-email');
                const userPhone = this.getAttribute('data-phone');
                const userAddress = this.getAttribute('data-address');
                
                // Populate the modal form with the data
                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserName').value = userName;
                document.getElementById('editUserType').value = userType;
                document.getElementById('editUserEmail').value = userEmail;
                document.getElementById('editUserPhone').value = userPhone;
                document.getElementById('editUserAddress').value = userAddress;
            });
        });

        // Handle "Add User" button click
        addUserBtn.addEventListener('click', function () {
            const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
            addUserModal.show();
        });

        // Handle form submission for editing user
        document.getElementById('editUserForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Collect form data
            const userId = document.getElementById('editUserId').value;
            const userName = document.getElementById('editUserName').value;
            const userType = document.getElementById('editUserType').value;
            const userEmail = document.getElementById('editUserEmail').value;
            const userPhone = document.getElementById('editUserPhone').value;
            const userAddress = document.getElementById('editUserAddress').value;
            
            // TODO: Handle form submission (e.g., AJAX request to update user in the database)
            console.log('Editing User ID:', userId);
            console.log('Name:', userName);
            console.log('Type:', userType);
            console.log('Email:', userEmail);
            console.log('Phone:', userPhone);
            console.log('Address:', userAddress);
            
            // Hide the modal and reload the user page
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
            editModal.hide();
            
            // Reload the page to reflect changes
            window.location.reload();
        });

        // Handle form submission for adding user
        document.getElementById('addUserForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Collect form data
            const userName = document.getElementById('addUserName').value;
            const userType = document.getElementById('addUserType').value;
            const userEmail = document.getElementById('addUserEmail').value;
            const userPhone = document.getElementById('addUserPhone').value;
            const userAddress = document.getElementById('addUserAddress').value;
            
            // TODO: Handle form submission (e.g., AJAX request to add new user to the database)
            console.log('Adding User:');
            console.log('Name:', userName);
            console.log('Type:', userType);
            console.log('Email:', userEmail);
            console.log('Phone:', userPhone);
            console.log('Address:', userAddress);
            
            // Hide the modal and reload the user page
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
            addModal.hide();
            
            // Reload the page to reflect changes
            window.location.reload();
        });

        // Handle "Delete User" button click
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                userIdToDelete = this.getAttribute('data-id');
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                deleteModal.show();
            });
        });

        // Handle "Confirm Delete" button click
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (userIdToDelete) {
                // Send an AJAX request to delete the user
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'user_id': userIdToDelete
                    }),
                })
                .then(response => response.text())
                .then(result => {
                    if (result === 'success') {
                        alert('User deleted successfully!');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Error deleting user.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
    </script>
</body>
</html>
