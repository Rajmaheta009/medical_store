<footer class="footer bg-primary text-white py-4" id="about_as">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>About Us</h5>
                <p>We are a leading medical store providing top-quality medicines and health products. Our mission is to improve the health and well-being of our customers through excellent service and quality products.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li>Surat</li>
                    <li>Email: <a href="mailto:R@JMAHETA.com" class="text-white">R@JMAHETA.com</a></li>
                    <li>Phone: <a href="tel:+917600230222" class="text-white">7600230222</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Follow Us</h5>
                <ul class="list-unstyled d-flex">
                    <li class="me-3"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="me-3"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>
                    <li class="me-3"><a href="https://www.instagram.com/raj_maheta_/" class="text-white"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/raj-maheta-8315652b6/" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>

        </div>
        <div class="text-center mt-3">
            <p>&copy; 2024 Medical Store. All rights reserved.</p>
        </div>
    </div>
    <div class="uper_btn">
        <a href="#header" style="color:aliceblue;"><i class="bi bi-arrow-up-circle-fill"></i></a>
    </div>
</footer>


<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="assets/js/js/jquery.min.js"></script> -->
<script src="assets/js/owl_js/owl.carousel.js"></script>
<script src="assets/js/owl_js/Jequery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(function() {
        // Owl Carousel
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: false,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true
        });
    });
    var productid = localStorage.getItem('product-id');
</script>
</body>

</html>