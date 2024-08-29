<?php include 'headerfile.PHP'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Type Details</title>
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
            background-color: #fff;
            color:#121212;
        }
        body.dark-mode .table tbody tr{
            background-color: rgba(79, 79, 79, 0.344);
            color: #ffffff;
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
                <h1 class="h2">Users Role</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2" style="margin-right:120px;">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name_user</td>
                        <td>Active // Non-Active</td>
                        </tr>
                </tbody>
            </table>
    </main>
</div>

    <!-- Add Bootstrap JS and dependencies (Only once) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEmeIV1m8gOnjK5la4aLHEkThD91D/ePb3qu5RcnPjkp6dF+Z2xjK3M13uoDIWdpE" crossorigin="anonymous"></script>
    
    <!-- Dark Mode JavaScript -->
    <script>
       // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });
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
