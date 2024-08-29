<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s ease;
            z-index: 1000;
            background-color: #343a40;
            color: #fff;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link img {
            margin-right: 10px;
        }

        .sidebar .nav-link span {
            display: inline;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
        }

        .sidebar .nav-link i {
            margin-right: 15px;
            font-size: 1.2rem;
        }

        /* General styling for nav links */
        .sidebar .nav-link {
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease, padding 0.3s ease;
            color: #adb5bd; /* Light gray text color */
            font-weight: 500; /* Slightly bolder text */
        }

        /* Hover effect for non-active items */
        .sidebar .nav-link:hover {
            color: #fff; /* Text changes to white */
            padding-left: 20px; /* Adds a slight padding shift to the left */
        }

        /* Active link with blue background (more refined and professional) */
        .sidebar .nav-link.active {
            color: #fff; /* White text for active item */
            font-weight: 600; /* Slightly bolder to indicate it's active */
            padding-left: 15px; /* Neutral padding for active state */
        }

        /* Prevent hover effect on active items */
        .sidebar .nav-link.active:hover {
            color: #fff;
            padding-left: 15px; /* Maintain padding for active */
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease, width 0.3s ease;
            width: calc(100% - 250px);
        }

        .main-content.shifted {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        .toggle-btn {
            position: absolute;
            left: 103%;
            width: 35px;
            padding: 5px 8px;
            font-size: 0.9rem;
            transition: right 0.3s ease;
            z-index: 1100;
            border: none;
        }

        .sidebar.collapsed .toggle-btn {
            left: 115%;
        }

        .bg-dark-custom {
            background-color: #343a40 !important;
        }

        .toggle-btn i {
            font-size: 1.2rem;
        }

        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .chart-card {
            flex: 1;
            min-width: 300px;
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-card .card-body {
            padding: 20px;
        }

        .chart-container canvas {
            height: 300px;
            width: 100% !important;
            /* Ensure charts are responsive */
        }

        table {
            margin-top: 20px;
        }

        table th,
        table td {
            text-align: center;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
            
        }
    </style>
</head>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark-custom text-light sidebar">
                <div class="position-sticky">
                    <!-- Toggle Button in Sidebar -->
                    <button class="btn toggle-btn" id="toggleBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link active d-flex align-items-center" href="index.php">
                                <i class="fas fa-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="userpage.php">
                                <i class="fas fa-user"></i> <span>User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="product.php">
                                <i class="fas fa-box"></i> <span>Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="pharmacy.php">
                                <i class="fas fa-pills"></i> <span>Pharmacy</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="inventery.php">
                                <i class="fas fa-file"></i> <span>Inventory Report</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="user_type.php">
                                <i class="fas fa-users"></i> <span>User Type</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center" href="product_type.php">
                                <i class="fas fa-book"></i> <span>Product Type</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i> <span>Report</span>
                            </a>
                            <ul class="dropdown-menu bg-dark-custom text-light" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-light" href="#">Sales Report</a></li>
                                <li><a class="dropdown-item text-light" href="#">Feedback Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</body>

</html>
