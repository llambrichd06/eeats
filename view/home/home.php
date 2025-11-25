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
                    <a href="" class="">
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

    <section id="discounts">
        <div></div>
    </section>

    <section id="premiumAd">
        <div></div>
    </section>
