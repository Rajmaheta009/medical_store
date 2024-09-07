<?php include 'include/header.php';?>    
    <!-- Main Content -->
    <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div> -->
        <h1 class="h2">Deshboard</h1>
        <!-- Chart Section -->
        <div class="chart-container" >
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
    <?php include 'include/fotter.php';?>