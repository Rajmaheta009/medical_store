<?php include 'include/header.php'; ?>
<div class="container mt-5 shadow" >
    <div class="row ">
        <div class="col-md-4 bg-primary p-5 text-white">
            <h2>How Can I Help You?</h2>
            <p>we're open for any suggestion or just in have a chat</p>
            <div class="r d-flex mt-2">
                <i class="bi bi-geo-alt"></i>
                <p class="mt-3 ms-3">Address: 131,AITANAGR,NEAR BY SITANAGAR CHOCKDI,PUNAGAM,SURAT,GUJARAT</p>
            </div>
            <div class="r d-flex mt-2"><i class="bi bi-telephone-inbound"></i>
                <p class="mt-3 ms-3">PHONE : 7600230222</p>
            </div>
            <div class="r d-flex mt-2"><i class="bi bi-envelope-at-fill"></i>
                <p class="mt-3 ms-3">EMAIL : R@JMAHETA.com</p>
            </div>
        </div>
        <div class="col-md-8 p-5">
            <h2>Tell Me!</h2>
            <form class="row g-3 contactform mt-4">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">FRIST NAME</label>
                    <input type="text" class="form-control" id="fname">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">LAST NAME</label>
                    <input type="text" class="form-control" id="lname">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">SUBJECT</label>
                    <input type="text" class="form-control" id="subject">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">EMAIL ID</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>

                <div class="col-md-6">
                    <label for="inputZip" class="form-label">CONTACT NUMBER</label>
                    <input type="text" class="form-control" id="contactnumber">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-3">SEND ME!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/fotter.php'; ?>