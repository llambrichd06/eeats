<section id="prodBanner" class="margin d-flex align-items-center justify-content-center flex-column"> 
    
</section>
<div class="margin">
<section class="container-fluid d-flex flex-column align-items-center text-center px-0" id="products"> 
    <h2 class="py-2 mt-5">Avalible Products</h2>
    <div class="row w-100">
        <?php foreach ($products as $product) { ?>
            <div class="col-md-4 col-sm-12 p-2">
                <a href="?controller=Product&action=showProduct&idProduct=<?=$product->getId()?>" class=""> <!-- TODO: Poner enlaces correctos una vez este la pagina de productos creada -->
                    <div class="d-flex flex-column prodCard justify-content-center h-100 py-5 align-items-center" style="background-image: url('/resources/images/<?=$product->getImg()?>');">
                        <p class="foodTitle"><?=$product->getName() ?? "Name"?></p>
                        <p class="foodItem">View product page</p>
                        <div class="cardHomeHover cardProdHover"></div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
</div>