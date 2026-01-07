    <section id="banner" class="margin d-flex align-items-center justify-content-center flex-column"> 
        <h1>Your go-to place for amazing foods!</h1>
        <a href="?controller=Product&action=showProductPage" class="btn btn-primary">BROWSE MENU</a>
    </section>
    <div class="margin">
    <section class="container-fluid d-flex flex-column align-items-center text-center px-0 greyBg" id="featuredFoods"> 
        <h2 class="py-2 mt-5">Featured Foods</h2>
        <div class="row w-100">
            <?php foreach ($featuredProds as $product) { ?>
                <div class="col-md-4 col-sm-12 p-2">
                    <a href="?controller=Product&action=showProduct&idProduct=<?=$product->getId()?>" class="">
                        <div class="d-flex flex-column prodCard justify-content-center h-100 py-5 align-items-center" style="background-image: url('/resources/images/<?=$product->getImg()?>');">
                            <p class="foodTitle"><?=$product->getName() ?? "Name"?></p>
                            <p class="foodItem">View product page</p>
                            <div class="cardHomeHover"></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="container-fluid d-flex flex-column align-items-center text-center px-0 greyBg" id="discounts">
        <h2 class="py-2 mt-5">Latest Discounts</h2>
        <div class="row w-100">
            <?php foreach ($latestDiscount as $discount) { ?>
                <div class="col-md-4 col-sm-12 p-2">
                    <div class="card " >
                        <a href="" class="card-img-top">
                            <img src="/resources/images/<?=$discount['img']?>" alt="Discounted product image" class="img-fluid">
                        </a>
                        <div class="card-body">
                            <p class="card-text">Product <?=$discount['name'] ?? "Name"?> is on <?=$discount['percent'] ?? "__"?>% discount untill <?=substr($discount['ends_at'], 0, 10) ?? "0000-00-00"?>!</p>
                            <a href="?controller=Product&action=showProduct&idProduct=<?=$discount['product_id']?>" class="btn btn-primary ">View Product</a>
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
                <img src="/resources/images/EEPremium.svg" alt="Electronic Eats pink logo">
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
