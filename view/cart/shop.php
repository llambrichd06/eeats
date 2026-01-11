<section class="margin">
    <h1>Shop</h1>
    <div class="d-flex flex-column align-items-center greyBg mb-3 px-3">

        <?php if (count($_SESSION['cart']) == 0) { ?>
            <p>Your cart is empty.</p>
        <?php } else { ?>

            <div class="row pt-2 mb-2 w-100">
                <div class="col-4"><b class="shopHeading">Product</b></div>
                <div class="col-2 p-0"><b class="shopHeading">Amount</b></div>
                <div class="col-6 text-end pe-5"><b class="shopHeading">Price</b></div>
            </div>

            <div class="w-100 d-flex justify-content-center  pb-3">
                <div class="w-100 border-bottom border-black"></div>
            </div>

            <?php foreach ($_SESSION['cart'] as $key =>$item) { 
                $product = ProductDAO::getProductById($item['product_id']); 
                $price = $product->getPrice()*$item['quantity'];
                $totalPrice += $price; ?>

            <div class="row w-100 align-items-center ">
                
                <div class="col-4 d-flex px-0 align-items-center">
                    <img src="/resources/images/<?=$product->getImg()?>" alt="Product photo" class="shopImgWidth shadow">
                    <div class="shopTxtWidth ps-2">
                        <p class="p-0 text-start fw-bold"><?= $product->getName() ?? "Nameless product" ?></p>
                    </div>
                </div>

                <div class="col-2 px-0">
                    <p class="m-0"><?= $item['quantity'] ?? 1 ?>x</p>
                </div>

                <div class="col-4 shopDottedLine border-black px-0"></div>

                <div class="col-2 d-flex justify-content-center gap-4 align-items-center">
                    <b><?= $price ?> €</b>
                    <form action="" method="post">
                        <button type="submit" name="deletePos<?=$key?>" class="border-0 noBg"><img src="/resources/images/deleteIcon.svg" alt="Trash Bin Icon"></button>
                    </form>
                </div>

            </div>

            <?php if (count($_SESSION['cart']) != $key + 1) { ?>

            <div class="w-100 d-flex justify-content-center py-3">
                <div class="w-75 border-bottom"></div>
            </div>

            <?php }} ?>

            <div class="w-100 d-flex justify-content-center py-3">
                <div class="w-100 border-bottom border-black"></div>
            </div>
            
            <div class="d-flex justify-content-start align-items-center w-100 gap-2  mb-3">

            <?php if (isset($_POST['promoCode']) && $_POST['promoCode'] != 'notFound') {?>

            <form action="" method="post" class="w-100 d-flex justify-content-start align-items-center gap-2">
                <p class="m-0">Applied code: <?= $_POST['promoCode'] ?></p>
                <button type="submit" class="btn btn-primary promoCodeButton" name="unApplyCode">Unapply</button>
            </form>

            <?php } else { ?>

                <form action="" method="post" class="w-100 d-flex justify-content-start align-items-center gap-2">
                    <label for="promoCode">Apply Promotional Code</label>
                    <input type="text" name="promoCode" id="promoCode" class="promoCodeInput" placeholder="Enter your code here!">
                    <button type="submit" class="btn btn-primary promoCodeButton">Apply</button>
                
                <?php if (isset($_POST['promoCode']) && $_POST['promoCode'] == 'notFound') { ?>
                    <p class="m-0">Invalid promotional code.</p>
                <?php unset($_POST['promoCode']); } ?>
                </form>

            <?php } ?>
            </div>
            <b class="w-100 text-start mb-3">Total: <?= $discountPercent != 0 ? "<s>$totalPrice</s> -> " . number_format(($totalPrice - ($totalPrice * ($discountPercent / 100))), 2) : number_format($totalPrice, 2) ?> €</b>
            <form action="?controller=Cart&action=showCheckout" method="post" class="w-100">
                <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
                <?php if ($discountPercent) { ?>
                    <input type="hidden" name="discountPercent" value="<?= $discountPercent ?>">
                <?php } ?>
                <button type="submit" class="btn btn-primary w-100 checkoutBtn mb-3">CHECKOUT</button>
            </form>
            <?php } ?>


    </div>
</section>