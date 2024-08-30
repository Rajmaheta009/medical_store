<?php include 'header.php';?>
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
                        <td><span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="ADDRESS"><i class="fa-solid fa-location-dot"></i></span></td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                                data-id="1" data-name="Name_user" data-type="Customer" data-email="name@gmail.com" data-phone="1234567890" data-address="Address">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger delete btn" type="button" data-id="1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        <!-- Modal for Adding User -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="userName" class="form-label" style="color:#333;">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="userName" id="userName">
                                </div>
                                <div class="col">
                                    <label for="contactNo" class="form-label" style="color:#333;">Contact No</label>
                                    <input type="number" class="form-control" placeholder="Contact No" aria-label="Contact No" name="contactNo" id="contactNo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label" style="color:#333;">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
                                </div>
                                <div class="col">
                                    <label for="password" class="form-label" style="color:#333;">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="role" class="form-label" style="color:#333;">Role</label>
                                    <input type="text" class="form-control" placeholder="Role" aria-label="Role" name="role" id="role">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'fotter.php';?>