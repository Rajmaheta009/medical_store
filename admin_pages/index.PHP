<?php
include 'headerfile.PHP'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Store Dashboard</title>
</head>
<body>
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <!-- Chart Card for Bar Chart -->
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title">User Statistics</h5>
                    <canvas id="userBarChart"></canvas>
                </div>
            </div>
            <!-- Chart Card for Product Doughnut Chart -->
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title">Product Distribution</h5>
                    <canvas id="productRingChart"></canvas>
                </div>
            </div>
            <!-- Chart Card for Inventory Doughnut Chart -->
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title">Inventory Status</h5>
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
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Details</th>
                    <th scope="col">Price</th>
                    <th scope="col">Selling Price</th>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 1" class="img-fluid"></td>
                    <td>Medicine A</td>
                    <td>Detail about Medicine A</td>
                    <td>$10.00</td>
                    <td>$12.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 2" class="img-fluid"></td>
                    <td>Medicine B</td>
                    <td>Detail about Medicine B</td>
                    <td>$15.00</td>
                    <td>$18.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 3" class="img-fluid"></td>
                    <td>Medicine C</td>
                    <td>Detail about Medicine C</td>
                    <td>$8.00</td>
                    <td>$10.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 4" class="img-fluid"></td>
                    <td>Medicine D</td>
                    <td>Detail about Medicine D</td>
                    <td>$20.00</td>
                    <td>$25.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 5" class="img-fluid"></td>
                    <td>Medicine E</td>
                    <td>Detail about Medicine E</td>
                    <td>$12.00</td>
                    <td>$15.00</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Expiry Medicines List</h1>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Exp Date</th>
                    <th scope="col">Offer</th>
                    <th scope="col">Price</th>
                    <th scope="col">Selling Price</th>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 1" class="img-fluid"></td>
                    <td>Medicine A</td>
                    <td>12/10/2029</td>
                    <td>20%</td>
                    <td>$10.00</td>
                    <td>$12.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 2" class="img-fluid"></td>
                    <td>Medicine B</td>
                    <td>12/10/2029</td>
                    <td>20%</td>
                    <td>$15.00</td>
                    <td>$18.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 3" class="img-fluid"></td>
                    <td>Medicine C</td>
                    <td>12/10/2029</td>
                    <td>20%</td>
                    <td>$8.00</td>
                    <td>$10.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 4" class="img-fluid"></td>
                    <td>Medicine D</td>
                    <td>12/10/2029</td>
                    <td>20%</td>
                    <td>$20.00</td>
                    <td>$25.00</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/50" alt="Medicine 5" class="img-fluid"></td>
                    <td>Medicine E</td>
                    <td>12/10/2029</td>
                    <td>20%</td>
                    <td>$12.00</td>
                    <td>$15.00</td>
                </tr>
            </tbody>
        </table>
    </main>
    </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
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
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Can be 'top', 'left', 'bottom', 'right'
                        labels: {
                            color: '#333' // Color of the legend labels
                        }
                    }
                },
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
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Can be 'top', 'left', 'bottom', 'right'
                        labels: {
                            color: '#333' // Color of the legend labels
                        }
                    }
                }
            }
        });

        // Doughnut Chart for Inventory
        const inventoryRingChart = new Chart(document.getElementById('inventoryRingChart'), {
            type: 'doughnut',
            data: {
                labels: ['In Stock', 'Out of Stock'],
                datasets: [{
                    data: [75, 25],
                    backgroundColor: ['#4CAF50', '#F44336'],
                    hoverBackgroundColor: ['#4CAF50', '#F44336']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Can be 'top', 'left', 'bottom', 'right'
                        labels: {
                            color: '#333' // Color of the legend labels
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>