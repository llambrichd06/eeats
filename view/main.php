<?php
    session_start();
    $userLoggedIn = isset($_SESSION['user']);
    var_dump($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/main.css">
    <title>Document</title>
</head>
<body class="">

    <!-------------- HEADER ----------------->
    <header class="container-fluid text-center margin">
        <nav class="row d-flex">
            <div class="col-3">
                <img src="../resources/images/EENameLogo.png" alt="Logo and name of website, Electronic Eats" class="img-fluid">
            </div>
            <div class="col-6 d-flex align-items-center">
                <ul class="d-flex align-items-center gap-2">
                    <li><a href="" class="">FOODS</a></li>
                    <li><a href="">DISCOUNTS</a></li>
                </ul>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-end gap-2">
            <a href="<?= $userLoggedIn ? '' : '?controller=Session&action=showLogin'?>">
                <img src="../resources/images/profileicon.svg" alt="Profile Icon" class="img-fluid">
            </a>
            <a href="">
                <img src="../resources/images/cartIcon.svg" alt="Cart Icon" class="img-fluid">
            </a>
            </div>
        </nav>
    </header>

    <!-------------- MAIN CONTENT ----------------->
    <main class="container-fluid px-0 text-center">
        <?php include_once $view?> 
    </main>

    <!-------------- FOOTER ----------------->
    <footer class="container-fluid footerPad">
        <div class="row-2 d-flex justify-content-between margin">
            <nav>
                <ul class="d-flex align-items-center gap-4">
                    <li><a href="?controller=Home&action=index">Home</a></li>
                    <li><a href="">Foods</a></li>
                    <li><a href="">Cart</a></li>
                </ul>
            </nav>
            <div class="d-flex flex-column align-items-end">
                <strong class="text-right">Join The Conversation</strong>
                <div>
                    <img src="" alt="Facebook">
                    <img src="" alt="Twitter">
                    <img src="" alt="Youtube">
                    <img src="" alt="Instagram">
                    <img src="" alt="Twitch">
                    <img src="" alt="Linkedin">
                </div>
            </div>
        </div>
        <div class="row-2 d-flex justify-content-between margin downFooter">
            <div class="d-flex">
                <img src="../resources/images/LogoEEats.svg" alt="Logo EEats" class="img-fluid">
                <div>
                    <div class="d-flex justify-content-start align-items-center gap-4 ps-1">
                        <a href="" class="footerMenu">Products</a>
                        <a href="" class="footerMenu">Premium</a>
                        <a href="" class="footerMenu">About</a>
                        <a href="" class="footerMenu">Contact</a>
                    </div>
                    <div>
                        <a href="">Privacy Policy & Cookies</a>
                    </div>
                </div>
            </div>
            <div class="px-3">
                <p>Regional Pricing</p>
                <div class="d-flex">
                    <select name="" id="" class="w-100">

                    </select>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>