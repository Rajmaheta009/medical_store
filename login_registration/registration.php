<?php
include "../database/collaction.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // MongoDB connection

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    if ($username or $password or $email != null) {
        // $ph_no = $_POST['ph_no'];

        // Check if the username already exists
        $existingUser = $login_registration_collection->findOne(['username' => $username]);
        if ($existingUser) {
            echo '<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
            window.onload = function() {
                alertify.set("notifier","position", "top-right");
                alertify.success("User Name is already Entered... So Please Choice Other User Name !");
                setTimeout(function() {
                    window.location.href = "login_registration.html";
                }, 1000);
            };
        </script>';
        } else {
            // Hash the password before storing it
            $result = $login_registration_collection->insertOne([
                'username' => $username,
                'password' => $password,
                'email' => $email,
                // 'ph_no' => $ph_no
            ]);

            if ($result->getInsertedCount() > 0) {
                echo '<script type="text/javascript" src="assets/js/sweetalert.js"></script>
        <script type="text/javascript"> 
            window.onload = function(){ 
                swal({
                    title: "Insert Data Is Successfully",
                    icon: "success",
                    button: "Aww yiss!",
                }).then(function(){ 
                    window.location.href = login_registration.php";
                });
            };
        </script>';
                header("location: login_registration.html");
            } else {
                echo "Registration failed. Please try again.";
            }
        }
    }
    else{
        echo "something is wrong....please check !";
    }
}
