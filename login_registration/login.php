<?php 
    include "../database/collaction.php"; 
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $login_registration_collection->findOne(['email' => $email]);
        
        if ($user && $password == $user['password']) {
            echo '<script type="text/javascript" src="../admin_side/assets/js/sweetalert.js"></script>
        <script type="text/javascript"> 
            window.onload = function(){ 
                swal({
                    title: "Login Is Successfully",
                    icon: "success",
                    button: "Aww yiss!",
                }).then(function(){ 
                    window.location.href = "../admin_side/dashboard.php";
                });
            };
        </script>';
            exit();
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
            <script>
                window.onload = function() {
                    alertify.set("notifier","position", "top-right");
                    alertify.success("Login Failed ..!");
                    setTimeout(function() {
                        window.location.href = "Slogin_registration.html";
                    }, 1000);
                };
            </script>';
        }
    }
?>
