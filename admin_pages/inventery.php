<?php 
    include 'headerfile.PHP'
    ?>
<div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Inventory</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button class="btn btn-primary" type="button" id="addProductBtn" style="margin-left:6px" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-user-plus"></i> Add Product
                    </button>
                </div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Selling_price</th>
                    <th scope="col">Quntity</th>
                    <th scope="col">selling_Quntity</th>
                    <th scope="col">avaliable_Quntity</th>
                    <th scope="col">Exp_Date</th>
                    <th scope="col">Action</th>
                </tr>
                    <tr>
                    <th scope="row">name</th>
                    <td>$10.00</td>
                    <td>$15.00</td>
                    <td>10</td>
                    <td>5</td>
                    <td>4</td>
                    <td>28/12/2024</td>
                    <td>28/12/2024</td>
                    </tr>
                    <tr>
                    <th scope="row">name</th>
                    <td>$10.00</td>
                    <td>$15.00</td>
                    <td>10</td>
                    <td>5</td>
                    <td>4</td>
                    <td>28/12/2024</td>
                    <td>28/12
                    </tr>
                    <tr>
                    <th scope="row">name</th>
                    <td>$10.00</td>
                    <td>$15.00</td>
                    <td>10</td>
                    <td>5</td>
                    <td>4</td>
                    <td>28/12/2024</td>
                    <td>28/12
                    </tr>
                </tbody>
            </table>
        </main>
<script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
        });
</script>