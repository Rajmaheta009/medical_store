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
                $datas = $user_type_collection->find();
                $counter = 1;
                foreach ($datas as $data) {  
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
                                data-status="<?php echo $data['status'] ? '1' : '0'; ?>"> <!-- Use '1' or '0' for status -->
                                <i class="fas fa-edit"></i>
                            </button>

                            <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
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
                                    <option value="manager">Manager</option>
                                    <option value="user_manager">User Manager</option>
                                    <option value="product_manager">Product Manager</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="status" style="color:#333;">Select Status:</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
        const statusInput = document.getElementById('status');
        const modalTitle = document.getElementById('addUserModalLabel');

        // Clear form for adding a new user role
        addProductButton.addEventListener('click', function() {
            user_typeIdInput.value = ''; // Clear hidden ID
            roleInput.value = ''; // Clear role field
            statusInput.value = '1'; // Default status to Active
            modalTitle.innerText = 'Add User Role'; // Set modal title
        });

        // Fill the form for editing a user role
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const user_typeId = this.getAttribute('data-id');
                const role = this.getAttribute('data-role');
                const status = this.getAttribute('data-status');

                // Set the values in the modal inputs
                user_typeIdInput.value = user_typeId;
                roleInput.value = role;
                statusInput.value = status;
                modalTitle.innerText = 'Edit User Role'; // Set modal title
            });
        });
    });

    function confirmDelete(user_typeId) {
        if (confirm("Are you sure you want to delete this User Role?")) {
            window.location.href = `crud_code/user_type_delete.php?id=${user_typeId}`;
        }
    }
</script>
<?php include 'include/fotter.php'; ?>
