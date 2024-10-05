<?php include 'include/header.php'; ?>
<div class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" id="searchInput" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2" style="margin-left:2px;">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addUserBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus"></i> Add User
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-striped" id="usertable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/collaction.php';
                $datas = $user_collection->find()->toArray();
                $counter = 1; // Initialize counter for PHP
                $filtered_user = array_filter($datas, function ($data) {
                    return $data['check'] == true && $data['delete'] == false;
                });
                foreach ($filtered_user as $data) { ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($data['name']); ?></td>
                        <td><?php echo htmlspecialchars($data['role']); ?></td>
                        <td><?php echo htmlspecialchars($data['email']); ?></td>
                        <td><?php echo htmlspecialchars($data['phone']); ?></td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                                data-id="<?php echo $data['_id']; ?>"
                                data-name="<?php echo htmlspecialchars($data['name']); ?>"
                                data-phone="<?php echo htmlspecialchars($data['phone']); ?>"
                                data-email="<?php echo htmlspecialchars($data['email']); ?>"
                                data-role="<?php echo htmlspecialchars($data['role']); ?>"
                                data-check="<?php echo htmlspecialchars($data['check']); ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-id="<?php echo $data['_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal for Adding/Editing User -->
        <!-- Modal for Adding/Editing User -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">User Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_code/user_crud.php" method="POST" id="userForm">
                            <input type="hidden" id="userId" name="userId"> <!-- Hidden field for User ID -->
                            <div class="row">
                                <div class="col">
                                    <label for="userName" class="form-label" style="color:#333;">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                        name="userName" id="userName"
                                        pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed"
                                        maxlength="50" minlength="2" required>
                                </div>
                                <div class="col">
                                    <label for="contactNo" class="form-label" style="color:#333;">Contact No</label>
                                    <input type="tel" class="form-control" placeholder="Contact No" aria-label="Contact No"
                                        name="contactNo" id="contactNo"
                                        pattern="[0-9]{10}" title="Please enter a valid 10-digit contact number"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label" style="color:#333;">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                        name="email" id="email"
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                        title="Please enter a valid email address" required>
                                </div>
                                <div class="col">
                                    <label for="password" class="form-label" style="color:#333;">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                        name="password" id="password"
                                        minlength="6" maxlength="20"
                                        title="Password must be between 6 to 20 characters" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="role" style="color:#333;">Select Role:</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="manager">Manager</option>
                                    <option value="product_manager">Admin</option>
                                    <option value="user_manager">User</option>
                                </select>
                            </div>
                            <label class="form-label" style="color:#333;">Active</label>
                            <label class="ios-switch">
                                <input type="checkbox" checked name="check" value=1>
                                <span class="slider"></span>
                            </label>
                            <input type="hidden" name="delete" id="deleteField" value="false">
                            <div class=" d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" style="margin-top: 7px; margin-right: 10px;">Submit</button>
                                <button type="button" class="btn btn-secondary" style="margin-top: 7px;" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel" style="color:#333;">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color: #333;">
                        Are you sure you want to delete this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <!-- Toast message will be set here -->
        </div>
    </div>
</div>

<script>
    function showToast(message, type) {
        var toastEl = document.getElementById('liveToast');
        var toastBody = toastEl.querySelector('.toast-body');

        // Set the message
        toastBody.innerText = message;

        // Set background colors based on the type
        if (type === 'success') {
            toastBody.style.backgroundColor = '#d4edda'; // green
            toastBody.style.color = '#155724'; // dark green
        } else if (type === 'error') {
            toastBody.style.backgroundColor = '#f8d7da'; // red
            toastBody.style.color = '#721c24'; // dark red
        }

        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    function confirmDelete() {
        document.getElementById('deleteField').value = 1; // Set delete value to true
        document.getElementById('userForm').submit(); // Submit the form
    }


    document.addEventListener('DOMContentLoaded', function() {
        var modalEl = document.getElementById('addUserModal');
        modalEl.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            var userId = button.getAttribute('data-id');
            var userName = button.getAttribute('data-name');
            var userEmail = button.getAttribute('data-email');
            var userPhone = button.getAttribute('data-phone');
            var userRole = button.getAttribute('data-role');
            var userCheck = button.getAttribute('data-check');

            // Fill form fields
            document.getElementById('userId').value = userId || '';
            document.getElementById('userName').value = userName || '';
            document.getElementById('email').value = userEmail || '';
            document.getElementById('contactNo').value = userPhone || '';
            document.getElementById('role').value = userRole || '';
            document.querySelector('input[name="check"]').checked = userCheck === 'true';

            // Set the form action and modal title based on whether it's add or edit
            var modalTitle = document.getElementById('addUserModalLabel');
            var submitButton = document.querySelector('.modal-footer button[type="submit"]');

            if (userId) {
                modalTitle.innerText = 'Edit User';
                submitButton.innerText = 'Update';
            } else {
                modalTitle.innerText = 'Add User';
                submitButton.innerText = 'Add';
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button click
        var deleteConfirmModal = document.getElementById('deleteConfirmModal');
        deleteConfirmModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-id');
            var deleteField = document.getElementById('deleteField');
            var userIdInput = document.getElementById('userId');

            // Set hidden field to pass the userId and delete flag
            userIdInput.value = userId;
            deleteField.value = '1'; // Set delete to true
        });
    });
</script>

<?php include 'include/fotter.php'; ?>