    <?php

    ?>
    <!-- TODO: Completar pagina home. Tener cuidado con responsive, que es importante en esta pagina. -->
    <!-- RECORDAR QUE LA PAGINA CAMBIA BASTANTE CUANDO ESTA EN PANTALLA PEQUEÑA (header se comprime en un submenu, etc) -->
    
    <section id="banner"> 
        <div><p>test</p></div>
    </section>

    <!-- estaria bien hacer que los featured foods sean las comidas con mas order lines relacionados. -->
    <section class="container-fluid" id="featuredFoods"> 
        <div class="row">
            <?php foreach ($featuredProds as $product) { ?>
                <div class="col-4">
                    <?=$product->getName()?>
                    <?=$product->getDescription()?>
                    <img src="/resources/images/<?=$product->getImg()?>" alt="">
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
