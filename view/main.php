<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/resources/images/LogoEEats.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/main.css">
    <title>Electronic Eats</title>
</head>

<body class="">

    <!-------------- HEADER ----------------->
    <header class="container-fluid text-center margin">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex align-items-center">

                <!-- Logo  -->
                <a class="navbar-brand" href="?controller=Home&action=index">
                    <img src="../resources/images/EELogoText.svg" alt="Logo and name of website, Electronic Eats" class="img-fluid logo">
                </a>

                <!-- Burger menu -->
                <button class="navbar-toggler ms-auto"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- content inside burger menu -->
                <div class="collapse navbar-collapse" id="mainNavbar">

                    <!-- navigation links -->
                    <ul class="navbar-nav mx-auto gap-2 text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Product&action=showProductPage">FOODS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">DISCOUNTS</a>
                        </li>
                    </ul>

                    <!-- user and cart icons -->
                    <div class="navbar-nav gap-3 text-center d-flex">
                        <a class="nav-link" href="<?= $userLoggedIn ? '?controller=User&action=showUserPage' : '?controller=Session&action=showLogin' ?>">
                            <img src="../resources/images/profileicon.svg" alt="Profile Icon" class="img-fluid icons">
                        </a>

                        <a class="nav-link" href="?controller=Cart&action=showShop">
                            <img src="../resources/images/cartIcon.svg" alt="Cart Icon" class="img-fluid icons">
                        </a>
                    </div>

                </div>
            </div>
        </nav>
    </header>


    <!-------------- MAIN CONTENT ----------------->
    <main class="container-fluid px-0 text-center">
        <?php include_once $view ?>
    </main>

    <!-------------- FOOTER ----------------->
    <footer class="container-fluid footerPad">
        <!-- TOP FOOTER -->
        <div class="margin">
            <div class="row align-items-center align-items-md-start">
                <!-- Navigation -->
                <div class="col-12 col-md-6 footer-nav">
                    <nav>
                        <ul class="d-flex flex-row align-items-center gap-3 gap-md-4">
                            <li><a href="?controller=Home&action=index" class="footer-nav">Home</a></li>
                            <li><a href="?controller=Product&action=showProductPage" class="footer-nav">Foods</a></li>
                            <li><a href="?controller=Cart&action=showShop" class="footer-nav">Cart</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Social -->
                <div class="col-12 col-md-6 footer-social text-center text-md-end mt-4 mt-md-0">
                    <strong>Join the conversation</strong>
                    <div class="d-flex justify-content-center justify-content-md-end gap-3 mt-2 social-icons">
                        <a href="https://facebook.com"><img src="/resources/images/facebookLogo.svg" alt="Facebook"></a>
                        <a href="https://twitter.com"><img src="/resources/images/twitterLogo.svg" alt="Twitter"></a>
                        <a href="https://instagram.com"><img src="/resources/images/instagramLogo.svg" alt="Instagram"></a>
                        <a href="https://linkedin.com"><img src="/resources/images/linkedinLogo.svg" alt="Linkedin"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM FOOTER -->
        <div class="margin greyBg">
            <div class="row footer-bottom align-items-center">
                <div class="col-12 col-md-8 d-flex flex-column flex-md-row align-items-center align-items-md-start gap-3">
                    <a href="?controller=Home&action=index">
                        <img src="../resources/images/LogoEEats.svg" alt="Logo EEats" class="img-fluid">
                    </a>
                    <div class="text-center text-md-start">
                        <div class="row footer-links text-center ">
                            <div class="col-6">
                                <a href="?controller=Product&action=showProductPage" class="footerMenu">Products</a>
                            </div>
                            <div class="col-6">
                                <a href="" class="footerMenu">Premium</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="">Privacy Policy & Cookies</a>
                        </div>
                    </div>
                </div>

                <!-- ADMIN PANEL -->
                <?php if ($userLoggedIn && $_SESSION['user']['role'] == 'admin') { ?>
                    <div class="col-12 col-md-4 text-center text-md-end admin-link">
                        <a href="?controller=Admin&action=showLogin">Access admin panel</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> <!-- bootstrap js for burger menu -->

</html>