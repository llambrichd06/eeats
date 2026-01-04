<?php
include_once 'view/authenticator.php';

$totalPrice = $_POST['totalPrice'];
$discountPercent = $_POST['discountPercent'] ?? null;
if (isset($discountPercent)) {
    $discountedPrice = number_format(($totalPrice - ($totalPrice * $discountPercent / 100)), 2);
}
$promoCode = $_SESSION['promoCode'] ?? null;
?>
<section class="margin">
    <div class="d-flex align-items-center">
        <a href="?controller=Cart&action=showShop">Shop</a>
        <img src="/resources/images/rightArrow.svg" alt="Arrow Pointed Right">
        <p class="m-0">Billing</p>
    </div>
    <h1 class="text-start py-3">Billing Details</h1>
    <div class="d-flex gap-4 align-items-start">
        <form action="?controller=Purchase&action=processPurchase" method="post" class="container px-0 checkoutFormWidth">

            <!-- Credit Card -->
            <h2 class="fw-bold mb-3 text-start">Credit Card details</h2>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Name on card" required>
                        <label for="cardName">Name on card</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="0000 0000 0000 0000" required>
                        <label for="cardNumber">Card number</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YYYY" required>
                        <label for="expiry">Card expiration</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="cvc" name="cvc" placeholder="Code" required>
                        <label for="cvc">Card security code</label>
                    </div>
                </div>
            </div>

            <!-- Billing Address -->
            <h2 class="fw-bold mb-3 text-start">Billing address</h2>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country name" required>
                        <label for="country">Country</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        <label for="address">Address</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City name" required>
                        <label for="city">City</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="state" name="state" placeholder="State name" required>
                        <label for="state">State</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="00000" required>
                        <label for="zip">Zip Code</label>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <h2 class="fw-bold mb-3 text-start">Contact information</h2>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@domain.com" required>
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="123456789" required>
                        <label for="phone">Phone</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="subtotal" value="<?= $totalPrice ?>">
            <input type="hidden" name="total" value="<?= isset($discountedPrice) ? $discountedPrice : $totalPrice ?>">
            <input type="hidden" name="discountApplied" value="<?= $discountPercent ?>">
            
            <!-- Submit -->
            <button class="btn btn-primary checkoutBtn w-100 py-2 text-uppercase mb-3" type="submit">Confirm and pay</button>

        </form>
        <!-- Order Summary -->
        <div class="greyBg px-3 checkoutProdsWidth">
            <?php foreach ($_SESSION['cart'] as $key => $value) {
                $product = ProductDAO::getProductById($value['product_id']);
                $price = $product->getPrice() * $value['quantity']; ?>
                <div class="d-flex justify-content-between py-3">
                    <b><?= $product->getName() ?></b>
                    <b><?= number_format($price, 2) ?> €</b>
                </div>
                <?php if (count($_SESSION['cart']) != $key + 1) { ?>

                <div class="w-100 d-flex justify-content-center ">
                    <div class="w-75 border-bottom"></div>
                </div>

            <?php }} ?>
            <div class="w-100 d-flex justify-content-center pb-3">
                <div class="w-100 border-bottom border-black"></div>
            </div>
            <?php if (isset($_SESSION['promoCode'])) { ?>
                <div class="w-100">
                    <p class="text-start p-0">Promotional Code: <?= $_SESSION['promoCode'] ?></p>
                </div>
            <?php } ?>
            <div class="d-flex py-3">
                <?php if (isset($discountPercent)) { ?>
                    <b class="w-100 text-start ">Total: <?="<s>$totalPrice</s> -> $discountedPrice"?> €</b>
                <?php } else { ?>
                    <b>Total: <?= number_format($totalPrice, 2) ?> €</b>
                <?php } ?>
            </div>
        </div> 
    </div>
</section>