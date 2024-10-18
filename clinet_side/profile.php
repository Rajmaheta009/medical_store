<?php include 'include/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <!-- Profile Information Section -->
        <div class="col-lg-4 col-md-6">
            <div class="card profile-card">
                <div class="card-body text-center">
                    <img src="https://media.istockphoto.com/id/1201546329/photo/italian-mafia-gangster.jpg?s=612x612&w=0&k=20&c=y__16EKyPnCNaXaWsmUJr72AsqcuVlXEF29Ncj-YtrQ=" class="rounded-circle img-thumbnail profile-img" alt="Profile Image">
                    <h3 class="mt-3 profile-name">Raj Maheta</h3>
                    <p class="profile-role text-muted">Customer</p>
                    <button class="btn btn-primary mt-3 px-4" style="background-color:#65c5e4;">Edit Profile</button>
                </div>
            </div>
        </div>
        <!-- Activity Section -->
        <div class="col-lg-8 col-md-6">
            <div class="card activity-card">
                <div class="card-header bg-primary text-white">
                    Recent Activity
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="activity-item">
                            <div class="activity-date text-muted">Oct 18, 2024</div>
                            <div class="activity-text">Added a new product: <strong>Paracetamol 500mg</strong></div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-date text-muted">Oct 16, 2024</div>
                            <div class="activity-text">Updated stock for: <strong>Ibuprofen</strong></div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-date text-muted">Oct 15, 2024</div>
                            <div class="activity-text">Processed a new order: <strong>#12345</strong></div>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">View All Activities</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings and Other Information -->
    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Account Settings
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> Raj@medicalstore.com</p>
                    <p><strong>Phone:</strong> 7600230222</p>
                    <button class="btn btn-secondary">Update Settings</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Security Settings
                </div>
                <div class="card-body">
                    <p><strong>Password:</strong> ********</p>
                    <button class="btn btn-warning">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'include/fotter.php'; ?>