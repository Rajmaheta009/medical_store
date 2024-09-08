<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        
.ios-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
}

.ios-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 2px;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    border-radius: 50%;
    left: 0px;
    bottom: 0px;
    background-color: white;
    transition: .4s;
}

input:checked+.slider {
    background-color: #00e359;
    box-shadow: inset 0 0 0 2px rgba(0, 162, 63, 1);
}

input:checked+.slider:before {
    transform: translateX(26px);
}
    </style>
</head>
<body>
    <?php include 'navigationbar.php'?>
    <button id="darkModeToggle" class="btn btn-secondary dark-mode-toggle" style="justify-content: end; margin-left:95%; margin-top:18px;">
        <i class="fas fa-moon"></i>
    </button>

