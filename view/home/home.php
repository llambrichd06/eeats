    <?php

    ?>
    <!-- TODO: Completar pagina home. Tener cuidado con responsive, que es importante en esta pagina. -->
    <!-- RECORDAR QUE LA PAGINA CAMBIA BASTANTE CUANDO ESTA EN PANTALLA PEQUEÑA (header se comprime en un submenu, etc) -->
    
    <section id="banner"> 
        <div><p>test</p></div>
    </section>

    <section class="container-fluid d-flex flex-column align-items-center text-center px-0" id="featuredFoods"> 
        <h2>Featured Foods</h2>
        <div class="row w-100">
            <?php foreach ($featuredProds as $product) { ?>
                <div class="col-lg-4 col-sm-12 p-2">
                    <a href="" class=""> <!-- TODO: Poner enlaces correctos una vez este la pagina de productos creada -->
                        <div class="d-flex flex-column prodCard justify-content-center h-100 py-5" style="background-image: url('/resources/images/<?=$product->getImg()?>');">
                            <p><?=$product->getName() ?? "Name"?></p>
                            <p><?=$product->getDescription() ?? "Description"?></p>
                            <div class="cardHomeHover"></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="container-fluid d-flex flex-column align-items-center text-center px-0" id="discounts">
        <h2>Latest Discounts</h2>
        <div class="row w-100">
            <?php foreach ($latestDiscount as $discount) { ?>
                <div class="col-lg-4 col-sm-12 p-2">
                    <div class="card " >
                        <a href="" class="card-img-top">
                            <img src="/resources/images/<?=$discount['img']?>" alt="Imatge de producte en descompte" class="img-fluid">
                        </a>
                        <div class="card-body">
                            <p class="card-text">Product <?=$discount['name'] ?? "Name"?> is on <?=$discount['percent'] ?? "__"?>% discount untill <?=substr($discount['ends_at'], 0, 10) ?? "0000-00-00"?>!</p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>  
                </div>
                
                <!-- <div class="col-lg-4 col-sm-12 d-flex flex-column discMain">
                    <a href="" class="h-50">
                        <img src="/resources/images/<?=$discount['img']?>" alt="Imatge de producte en descompte" class="mh-100">
                    </a>
                    <div class="d-flex flex-column justify-content-center h-50">
                        <p>Product <?=$discount['name'] ?? "Name"?> is on <?=$discount['percent'] ?? "__"?>% discount untill <?=substr($discount['ends_at'], 0, 10) ?? "0000-00-00"?></p>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div> -->
            <?php } ?>
        </div>
    </section>

    <section class="p-5" id="premiumAd">
        <div>
            <div>
                <img src="" alt="">
                <h2></h2>
            </div>
            <div>
                <h3></h3>
                <p></p>
            </div>
            <div>
                <a href="" class="btn ">Join Now</a>
            </div>
        </div>
    </section>
