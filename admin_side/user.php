<?php include 'include/header.php'; ?>
<div class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addUserBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus"></i> Add User
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/collaction.php';
                $datas = $user_collection->find();
                $counter = 1; // Initialize counter for PHP
                foreach ($datas as $data) { ?>
                    <tr>
                        <td><?php echo $counter++; // Display incremented counter 
                            ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['role']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td><span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Address"><i class="fa-solid fa-location-dot"></i></span></td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                                data-id="<?php echo $data['_id']; ?>"
                                data-name="<?php echo $data['name']; ?>"
                                data-phone="<?php echo $data['phone']; ?>"
                                data-email="<?php echo $data['email']; ?>"
                                data-role="<?php echo $data['role']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal for Adding/Editing User -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">User Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_code/user_crud.php" method="POST">
                            <input type="hidden" id="userId" name="userId"> <!-- Hidden field for User ID -->
                            <div class="row">
                                <div class="col">
                                    <label for="userName" class="form-label" style="color:#333;">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="userName" id="userName" required>
                                </div>
                                <div class="col">
                                    <label for="contactNo" class="form-label" style="color:#333;">Contact No</label>
                                    <input type="number" class="form-control" placeholder="Contact No" aria-label="Contact No" name="contactNo" id="contactNo" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label" style="color:#333;">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email" required>
                                </div>
                                <div class="col">
                                    <label for="password" class="form-label" style="color:#333;">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="role" style="color:#333;">Select Role:</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="manager">Manager</option>
                                    <option value="product_manager">Product Manager</option>
                                    <option value="user_manager">User Manager</option>
                                    <option value="pharmacy_manager">Pharmacy Manager</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000"> <!-- Auto hide after 5 seconds -->
        <div class="toast-header" style="background-color:#333; color:aliceblue;">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="background-color:#333; color:aliceblue;">
            <!-- Toast message will be set here -->
        </div>
    </div>
</div>

<!-- Your content goes here -->

<script>
    function showToast(message) {
        var toastEl = document.getElementById('liveToast');
        var toastBody = toastEl.querySelector('.toast-body');
        toastBody.innerText = message;

        var toast = new bootstrap.Toast(toastEl, {
            delay: 5000 // Hide after 5 seconds
        });

        // Show the toast after 2 seconds (2000 milliseconds)
        setTimeout(function() {
            toast.show();
        }, 2000);
    }

    // URL parameter parsing function
    function getParameterByName(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const status = getParameterByName('status');
        const type = getParameterByName('type');

        if (status && type) {
            let message = '';

            if (status === 'success' && type === 'add') {
                message = 'User added successfully!';
            } else if (status === 'success' && type === 'edit') {
                message = 'User updated successfully!';
            } else if (status === 'failed' && type === 'edit') {
                message = 'Failed to update user!';
            } else if (status === 'failed' && type === 'add') {
                message = 'Failed to add user!';
            } else if (status === 'failed' && type === 'email_exists') {
                message = 'Email already exists!';
            }

            // Show the toast with the respective message if it's not empty
            if (message) {
                showToast(message);
            }
        }
    });
</script>



<!-- JavaScript to handle the Add/Edit User Modal behavior -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-outline-primary');
        const addUserButton = document.getElementById('addUserBtn');
        const userIdInput = document.getElementById('userId');
        const userNameInput = document.getElementById('userName');
        const contactNoInput = document.getElementById('contactNo');
        const emailInput = document.getElementById('email');
        const roleInput = document.getElementById('role');
        const passwordInput = document.getElementById('password');

        // Clear form fields when Add User button is clicked
        addUserButton.addEventListener('click', function() {
            userIdInput.value = ''; // Clear hidden User ID
            userNameInput.value = ''; // Clear name field
            contactNoInput.value = ''; // Clear phone field
            emailInput.value = ''; // Clear email field
            roleInput.value = ''; // Clear role field
            passwordInput.value = ''; // Clear password field
        });

        // Populate form when Edit button is clicked
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const phone = this.getAttribute('data-phone');
                const email = this.getAttribute('data-email');
                const role = this.getAttribute('data-role');

                // Set the values in the modal inputs
                userIdInput.value = userId;
                userNameInput.value = userName;
                contactNoInput.value = phone;
                emailInput.value = email;
                roleInput.value = role;

                // Password is usually not edited or displayed for security reasons, so it remains empty.
                passwordInput.value = '';
            });
        });
    });

    function confirmDelete(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Redirect to delete PHP script with user ID
            window.location.href = `crud_code/user_delte.php?id=${userId}`;
        }
    }
</script>

<?php include 'include/fotter.php'; ?>