<?php include 'include/header.php'; ?>
<div class="container-fluid">
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pharmacies</h1>
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Search by name" aria-label="Search by name" id="searchInput">
                <button class="btn btn-primary" type="button" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary" type="button" id="addPharmacyBtn" style="margin-right:90px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addPharmacyModal" data-action="add">
                    <i class="fas fa-plus"></i> Add Pharmacy
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pharmacy Name</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/collaction.php';
                $datas = $pharmacy_collection->find()->toArray();
                $filter_pharmacy=array_filter($datas,function($data){
                    return $data['check']== true && $data['delete'] == false;
                });
                $counter = 1;
                foreach ($filter_pharmacy as $data) {
                    $statusText = $data['status'] ? 'Active' : 'In-Active';
                    $statusClass = $data['status'] ? 'text-success' : 'text-danger';
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></td>
                        <td>
                            <!-- Edit button -->
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addPharmacyModal"
                                data-action="edit"
                                data-id="<?php echo $data['_id']; ?>"
                                data-name="<?php echo $data['name']; ?>"
                                data-phone="<?php echo $data['phone']; ?>"
                                data-email="<?php echo $data['email']; ?>"
                                data-check="<?php echo $data['check']; ?>"
                                data-status="<?php echo $data['status'] ? '1' : '0'; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Delete button -->
                            <button onclick="confirmDelete('<?php echo $data['_id']; ?>')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal for Adding/Editing Pharmacy -->
        <div class="modal fade" id="addPharmacyModal" tabindex="-1" aria-labelledby="addPharmacyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPharmacyModalLabel" style="color: #333;"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_code/pharmacy_crud.php" method="POST" style="color:black;">
                            <input type="hidden" id="pharmacyId" name="pharmacyId"> <!-- Hidden field for Pharmacy ID -->
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name" id="name" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" maxlength="50" minlength="2" required>
                            </div>
                            <div class="col">
                                <label for="contactNo" class="form-label">Contact No</label>
                                <input type="tel" class="form-control" placeholder="Contact No" aria-label="Contact No" name="contactNo" id="contactNo" pattern="[0-9]{10}" title="Please enter a valid 10-digit contact number" required>
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address" required>
                            </div>
                            <div class="row">
                                <label for="status">Select Status:</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
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
    </main>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div id="toast-header" class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="toast-body" class="toast-body">
            <!-- Toast message will be set here -->
        </div>
    </div>
</div>

<!-- JavaScript for Toast Notifications and Modal Behavior -->
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
                message = 'Pharmacy added successfully!';
            } else if (status === 'success' && type === 'edit') {
                message = 'Pharmacy updated successfully!';
            } else if (status === 'failed' && type === 'edit') {
                message = 'Failed to update pharmacy!';
            } else if (status === 'failed' && type === 'add') {
                message = 'Failed to add pharmacy!';
            }

            // Show the toast with the respective message and type
            if (message) {
                showToast(message, status);
            }
        }
    });
</script>

<!-- JavaScript for Modal Behavior and Search Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-outline-primary');
        const addPharmacyButton = document.getElementById('addPharmacyBtn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.getElementById('addPharmacyModal');
                const modalTitle = modal.querySelector('.modal-title');
                const action = this.getAttribute('data-action');

                if (action === 'edit') {
                    modalTitle.textContent = 'Edit Pharmacy';
                } else {
                    modalTitle.textContent = 'Add Pharmacy';
                }
                document.getElementById('deleteField').value = 'false';
                // Set form values based on action
                const pharmacyId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const phone = this.getAttribute('data-phone');
                const email = this.getAttribute('data-email');
                const check = this.getAttribute('data-check');
                const status = this.getAttribute('data-status');

                document.getElementById('pharmacyId').value = pharmacyId || ''; // Clear or set the Pharmacy ID
                document.getElementById('name').value = name || '';
                document.getElementById('contactNo').value = phone || '';
                document.getElementById('email').value = email || '';
                document.getElementById('check').value = cehck || '1';
                document.getElementById('status').value = status || ''; // Default to 'Active'
            });
        });

        addPharmacyButton.addEventListener('click', function() {
            const modal = document.getElementById('addPharmacyModal');
            const modalTitle = modal.querySelector('.modal-title');
            modalTitle.textContent = 'Add Pharmacy'; // Ensure this is set correctly
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    function confirmDelete(pharmacyId) {
        if (confirm('Are you sure you want to delete this pharmacy?')) {
            document.getElementById('deleteField').value = 'true';
            window.location.href = 'crud_code/pharmacy_crud.php?action=delete&id=' + pharmacyId;
        }
    }
</script>

<?php include 'include/fotter.php'; ?>