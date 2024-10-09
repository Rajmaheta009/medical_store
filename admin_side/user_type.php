<?php include 'include/header.php'; ?>
<div class="container-fluid">

    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users Role</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Search by role" aria-label="Search by role" aria-describedby="button-addon2" id="searchInput">
                <button class="btn btn-primary" type="button" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addUserBtn" style="margin-right:90px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-user-plus"></i> Add User Role
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-striped" id="user_typetable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/collaction.php';
                $datas = $user_type_collection->find()->toArray();
                $counter = 1;
                $filter_user_type = array_filter($datas, function ($data) {
                    return $data['check'] == true && $data['delete'] == false;
                });
                foreach ($filter_user_type as $data) {
                    $statusText = $data['status'] ? 'Active' : 'Inactive'; // Convert boolean to text
                    $statusClass = $data['status'] ? 'text-success' : 'text-danger'; // Apply appropriate class
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $data['role'] ?></td>
                        <td class="<?php echo $statusClass; ?>">
                            <?php echo $statusText; ?>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                                data-id="<?php echo $data['_id']; ?>"
                                data-role="<?php echo $data['role']; ?>"
                                data-check="<?php echo $data['check']; ?>"
                                data-status="<?php echo $data['status'] ? '1' : '0'; ?>"> <!-- Use '1' or '0' for status -->
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-id="<?php echo $data['_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbod>
        </table>

        <!-- Modal for Adding/Editing User Role -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">Add User Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_code/user_type_crude.php" method="POST">
                            <input type="hidden" id="user_typeId" name="user_typeId">
                            <div class="row">
                                <label for="role" class="form-label" style="color:#333;">User Role</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="manager">admin</option>
                                    <option value="user_manager">clint</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="status" style="color:#333;">Select Status:</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <label class="form-label" style="color:#333;">Active</label>
                            <label class="ios-switch">
                                <input type="checkbox" checked name="check" value="1">
                                <span class="slider"></span>
                            </label>
                            <input type="hidden" name="delete" id="deleteField" value="false">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" style="margin-top: 7px; margin-right: 10px;">Submit</button>
                                <button type="button" class="btn btn-secondary" style="margin-top: 7px;" data-bs-dismiss="modal">Close</button>
                            </div>
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
                        <h5 class="modal-title" id="deleteConfirmModalLabel" style="color:#333;">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color: #333;">
                        Are you sure you want to delete this user role?
                    </div>
                    <div class="modal-footer">
                        <!-- Form for delete action -->
                        <form id="deleteForm" method="POST" action="crud_code/user_type_crude.php">
                            <input type="hidden" name="user_typeId" id="deleteUserTypeId">
                            <input type="hidden" name="delete" value="1">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">OK</button> <!-- Submit form on OK button click -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <!-- Auto hide after 5 seconds -->
        <div id="toast-header" class="toast-header text-white">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="toast-body" class="toast-body text-white">
            <!-- Toast message will be set here -->
        </div>
    </div>
</div>

<script>
    function showToast(message, type) {
        var toastEl = document.getElementById('liveToast');
        var toastHeader = document.getElementById('toast-header');
        var toastBody = document.getElementById('toast-body');

        // Set the message
        toastBody.innerText = message;

        // Set background colors based on the type
        if (type === 'success') {
            toastHeader.style.backgroundColor = 'green'; // Success background color
            toastBody.style.backgroundColor = 'green';
        } else if (type === 'failed') {
            toastHeader.style.backgroundColor = 'red'; // Failed background color
            toastBody.style.backgroundColor = 'red';
        }

        // Show the toast
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
                message = 'User role added successfully!';
            } else if (status === 'success' && type === 'edit') {
                message = 'User role updated successfully!';
            } else if (status === 'failed' && type === 'edit') {
                message = 'Failed to update user role!';
            } else if (status === 'failed' && type === 'add') {
                message = 'Failed to add user role!';
            }

            // Show the toast with the respective message and type
            if (message) {
                showToast(message, status);
            }
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#user_typetable tbody tr');

            rows.forEach(row => {
                const role = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                row.style.display = role.includes(query) ? '' : 'none';
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const addProductButton = document.getElementById('addUserBtn');
        const user_typeIdInput = document.getElementById('user_typeId');
        const roleInput = document.getElementById('role');
        const checkInput = document.getElementById('check');
        const statusInput = document.getElementById('status');
        const modalTitle = document.getElementById('addUserModalLabel');

        // Clear form for adding a new user role
        addProductButton.addEventListener('click', function() {
            modalTitle.innerText = 'Add User Role'; // Set modal title
            user_typeIdInput.value = ''; // Clear hidden ID
            roleInput.value = ''; // Clear role field
            statusInput.value = '1'; // Default status to Active
            checkInput.value = '1'; // Default status to Active
        });

        // Fill the form for editing a user role
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('deleteField').value = 'false';
                const user_typeId = this.getAttribute('data-id');
                const role = this.getAttribute('data-role');
                const check = this.getAttribute('data-check');
                const status = this.getAttribute('data-status');

                // Set the values in the modal inputs
                modalTitle.innerText = 'Edit User Role'; // Set modal title
                user_typeIdInput.value = user_typeId;
                roleInput.value = role;
                statusInput.value = status;
                checkInput.value = check;
            });
        });
    });


    function confirmDelete() {
        document.getElementById('deleteField').value = 1; // Set delete value to true
        document.getElementById('userForm').submit(); // Submit the form
    }
    document.addEventListener('DOMContentLoaded', function() {
        var deleteConfirmModal = document.getElementById('deleteConfirmModal');

        // Event listener for delete button click
        deleteConfirmModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var user_typeId = button.getAttribute('data-id'); // Get the user type ID from button attribute

            // Set the hidden input field with the user type ID
            var deleteUserTypeIdInput = document.getElementById('deleteUserTypeId');
            deleteUserTypeIdInput.value = user_typeId;
        });
    });
</script>
<?php include 'include/fotter.php'; ?>