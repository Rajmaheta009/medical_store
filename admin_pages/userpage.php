<?php include 'headerfile.PHP'; ?>
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
        /* Dark mode styles */
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
    </style>
</head>

<body>
    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle" class="btn btn-secondary dark-mode-toggle" style="margin-top:-4px;">
        <i class="fas fa-moon"></i> Dark Mode
    </button>

    <div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Users</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-light" type="button" id="button-addon2" style="margin-left:2px;">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button class="btn btn-light" type="button" id="addUserBtn" style="margin-right:120px; margin-left:6px;" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
                        <td><span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="ADDRESS"><button class="btn btn-primary" type="button" disabled>ADDRESS</button></span></td>
                        <td>
                            <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                data-id="1" data-name="Name_user" data-type="Customer" data-email="name@gmail.com" data-phone="1234567890" data-address="Address">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline-dark delete btn" type="button" data-id="1">
                                <i class="fas fa-trash"></i> Delete
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
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="userName" class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="userName" id="userName">
                                </div>
                                <div class="col">
                                    <label for="contactNo" class="form-label">Contact No</label>
                                    <input type="number" class="form-control" placeholder="Contact No" aria-label="Contact No" name="contactNo" id="contactNo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
                                </div>
                                <div class="col">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="role" class="form-label">Role</label>
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

    <!-- Add Bootstrap JS and dependencies (Only once) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEmeIV1m8gOnjK5la4aLHEkThD91D/ePb3qu5RcnPjkp6dF+Z2xjK3M13uoDIWdpE" crossorigin="anonymous"></script>
    
    <!-- Dark Mode JavaScript -->
    <script>
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
