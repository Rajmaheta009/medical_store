<?php include 'include/header.php'?>
<div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Pharmacy</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i> 
                    </button>
                    <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-right:90px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-user-plus"></i> Add Product
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pharmacy name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Name_user</td>
                        <td>Active // De-Active</td>
                        <td>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal"
                                data-id="1" data-name="Name_user" data-type="Customer" data-email="name@gmail.com" data-phone="1234567890" data-address="Address">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        </tr>
                </tbody>
            </table>
            <!-- Modal for Adding User -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel" style="color:#333;">product form</h5>
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
<?php include 'include/fotter.php' ?>