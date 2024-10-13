<?php
include "../database/collaction.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $login_registration_collection->findOne(['email' => $email]);

    if ($user && $password == $user['password']) {
        // Assuming you have some way to differentiate Admin and Client users
        if ($user['role'] == 'admin' or $user['role'] == 'manager') {  // For Admin users
            echo '<script type="text/javascript" src="../admin_side/assets/js/sweetalert.js"></script>
                <script type="text/javascript"> 
                    window.onload = function(){ 
                        swal({
                            title: "Login Successful",
                            icon: "success",
                            button: "Proceed to Dashboard",
                        }).then(function(){ 
                            window.location.href = "../admin_side/dashboard.php";
                        });
                    };
                </script>';
        } else {  // For Client users
            echo '<script type="text/javascript" src="../admin_side/assets/js/sweetalert.js"></script>
                <script type="text/javascript"> 
                    window.onload = function(){ 
                        swal({
                            title: "Login Successful",
                            icon: "success",
                            button: "Proceed to Home",
                        }).then(function(){ 
                            window.location.href = "../client_side/home.php";
                        });
                    };
                </script>';
        }
    } else {

        echo $email;
        echo $password;
        if($login_registration_collection->findOne(['email' => $email])){
            echo "Invalid Password";
        }
        else{
            echo "Invalid Email";
        }
        // echo $login_registration_collection->findOne(['email' => $email]);
        // Failed login logic (common for both Admin and Client)
        // echo '<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
        // <script>
        //     window.onload = function() {
        //         alertify.set("notifier","position", "top-right");
        //         alertify.error("Login Failed. Redirecting...");
        //         setTimeout(function() {
        //             window.location.href = "login_registration.html";
        //         }, 1000);
        //     };
        // </script>';
    }
}
