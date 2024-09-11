<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="top-bar">
        <i class="fas fa-map-marker-alt">Surat,Gujarat</i>3
        <i class="fas fa-phone">7600230222</i>
        <i class="fas fa-envelope"><a href="mailto:example@medicine-plus.com">R@JMAHETA.COM</a></i>
        <a href="#">CHECKOUT</a>
        <a href="#">MY WISHLIST</a>
        <a href="#">MY ACCOUNT</a>
        <a href="../login_registration/login_registration.html">LOG IN</a>
    </div>
    <div class="header">
        <div class="logo">
            <img src="https://placehold.co/50x50" alt="Shopping cart with a medical cross">
            <div>
                <h1>Medicine <span>Plus</span></h1>
                <p>welcome to our online store</p>
            </div>
        </div>
        <div class="contact-info">
            <img src="https://placehold.co/40x40" alt="Customer service representative">
            <div>
                <p>Have A Question?</p>
                <a href="contact_as.php">Chat with us!</a>
            </div>
        </div>
        <a href="cart.php">
            <div class="cart">
                <i class="fas fa-shopping-cart"></i>
                <span>£0.00</span>
                <span>(0)</span>
            </div>
        </a>
    </div>
    <?php include 'navigation.php'; ?>