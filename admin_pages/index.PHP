<?php
include 'headerfile.PHP'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Light mode styles */
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .card {
            background-color: #fff;
            border-color: #ddd;
        }
        .table {
            color: #333;
        }
        .table th, .table td {
            border-color: #ddd;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #fff;
        }
        .card.dark-mode {
            background-color: #1e1e1e;
            border-color: #333;
        }
        .table.dark-mode {
            color: #fff;
            background-color: #1e1e1e;
        }
        .table.dark-mode th, .table.dark-mode td {
            border-color: #333;
        }
        .border-bottom.dark-mode {
            border-color: #333;
        }

        /* Toggle Button Style */
        .dark-mode-toggle {
            position: fixed;
            top: 10px;
            right: 20px;
            z-index: 999;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .dark-mode-toggle.dark {
            background-color: #fff;
            color: #333;
        }
        /* Light mode styles for cards */
        .card {
        background-color: #fff;
        border-color: #ddd;
        color: #333;
        }

        /* Dark mode styles for cards */
        .dark-mode .card {
        background-color: #1e1e1e;
        border-color: #333;
        color: #ccc; /* Lighter text for better visibility */
        }

        /* Optional: Hover effect for cards in dark mode */
        .dark-mode .card:hover {
        background-color: #2c2c2c;
        }

        /* Chart title color adjustment for dark mode */
        .dark-mode .card-title {
        color: #ddd; /* Lighter text for titles */
        }

    </style>
</head>

<body>
    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle" class="btn btn-secondary dark-mode-toggle" style="margin-top:-4px;">
        <i class="fas fa-moon"></i> Dark Mode
    </button>

    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title" style="color:dimgrey">User Statistics</h5>
                    <canvas id="userBarChart"></canvas>
                </div>
            </div>
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title" style="color:dimgrey">Product Distribution</h5>
                    <canvas id="productRingChart"></canvas>
                </div>
            </div>
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title" style="color:dimgrey">Inventory Status</h5>
                    <canvas id="inventoryRingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Top Selling Medicines</h1>
        </div>
        <table class="table">
            <tbody>
                <!-- Table content... -->
            </tbody>
        </table>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Expiry Medicines List</h1>
        </div>
        <table class="table table-bordered">
            <tbody>
                <!-- Table content... -->
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //sidebar menu
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });

        // Dark Mode Toggle Functionality
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

        // Bar Chart for Users
        const userBarChart = new Chart(document.getElementById('userBarChart'), {
            type: 'bar',
            data: {
                labels: ['Admin', 'Manager', 'Employee', 'Customer'],
                datasets: [{
                    label: 'Number of Users',
                    data: [5, 10, 15, 25],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Doughnut Chart for Products
        const productRingChart = new Chart(document.getElementById('productRingChart'), {
            type: 'doughnut',
            data: {
                labels: ['Medicines', 'Supplements', 'Cosmetics'],
                datasets: [{
                    data: [30, 50, 20],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Doughnut Chart for Inventory
        const inventoryRingChart = new Chart(document.getElementById('inventoryRingChart'), {
            type: 'doughnut',
            data: {
                labels: ['In Stock', 'Out of Stock'],
                datasets: [{
                    data: [75, 25],
                    backgroundColor: ['#4CAF50', '#F44336']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>
