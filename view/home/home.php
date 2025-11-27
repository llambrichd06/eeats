    <?php

    ?>
    <!-- TODO: Completar pagina home. Tener cuidado con responsive, que es importante en esta pagina. -->
    <!-- RECORDAR QUE LA PAGINA CAMBIA BASTANTE CUANDO ESTA EN PANTALLA PEQUEÑA (header se comprime en un submenu, etc) -->
    
    <section id="banner" class="margin d-flex align-items-center justify-content-center flex-column"> 
        <h1>Your go-to place for amazing foods!</h1>
        <a href="" class="btn btn-primary">BROWSE MENU</a>
    </section>
    <div class="margin">
    <section class="container-fluid d-flex flex-column align-items-center text-center px-0" id="featuredFoods"> 
        <h2 class="py-2 mt-5">Featured Foods</h2>
        <div class="row w-100">
            <?php foreach ($featuredProds as $product) { ?>
                <div class="col-lg-4 col-sm-12 p-2">
                    <a href="" class=""> <!-- TODO: Poner enlaces correctos una vez este la pagina de productos creada -->
                        <div class="d-flex flex-column prodCard justify-content-center h-100 py-5 align-items-center" style="background-image: url('/resources/images/<?=$product->getImg()?>');">
                            <p class="foodTitle"><?=$product->getName() ?? "Name"?></p>
                            <p class="foodItem"><?=$product->getDescription() ?? "Description"?></p>
                            <div class="cardHomeHover"></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="container-fluid d-flex flex-column align-items-center text-center px-0" id="discounts">
        <h2 class="py-2 mt-5">Latest Discounts</h2>
        <div class="row w-100">
            <?php foreach ($latestDiscount as $discount) { ?>
                <div class="col-lg-4 col-sm-12 p-2">
                    <div class="card " >
                        <a href="" class="card-img-top">
                            <img src="/resources/images/<?=$discount['img']?>" alt="Discounted product image" class="img-fluid">
                        </a>
                        <div class="card-body">
                            <p class="card-text">Product <?=$discount['name'] ?? "Name"?> is on <?=$discount['percent'] ?? "__"?>% discount untill <?=substr($discount['ends_at'], 0, 10) ?? "0000-00-00"?>!</p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>  
                </div>
            <?php } ?>
        </div>
    </section>
    </div>
    <section class="container-fluid margin" id="premiumAd">
        <div class="py-5 d-flex flex-column gap-4">
            <div class="d-flex align-items-center gap-3">
                <img src="/resources/images/EEPremium.png" alt="Electronic Eats pink logo">
                <h2>Premium</h2>
            </div>
            <div class="d-flex flex-column">
                <h3>Unlock a world of thrill</h3>
                <p>Experience unlimited access to a collection of top EE foods,<br> discounts, and more.</p>
            </div>
            <div class="d-flex">
                <a href="" class="btn ">Join Now</a>
            </div>
        </div>
    </section>
