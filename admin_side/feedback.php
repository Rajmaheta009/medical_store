<?php include 'include/header.php';?>
<div class="container-fluid">
        <!-- Main Content -->
        <main id="mainContent" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Feedback</h1>
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Search by username" aria-label="Search by username" aria-describedby="button-addon2" id="searchInput">
                    <button class="btn btn-primary" type="button" id="button-addon2" style="margin-right:120px;">
                        <i class="fas fa-search"></i> 
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Review</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Name_user</td>
                        <td>Details</td>
                        </tr>
                </tbody>
            </table>
    </main>
</div>
<?php include 'include/fotter.php';?>