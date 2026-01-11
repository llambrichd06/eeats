<section class="d-flex flex-column align-items-center margin pt-3 greyBg">
    <h1><?= $product->getName() ?? "Nameless Product" ?></h1>
    <div class="w-100 d-flex">
        <div class="w-50 d-flex justify-content-center align-items-center py-5">
            <img src="/resources/images/<?= $product->getImg() ?>" alt="Image of <?= $product->getName() ?? "Nameless Product" ?>" class="img-fluid">
        </div>
        <div class="w-50 py-5">
            <form action="" method="post" class="d-flex flex-column align-items-center justify-content-center gap-3">
                <input type="hidden" name="addedProdId" id="addedProdId" value="<?= $product->getId() ?>">
                <p><?= $product->getDescription() ?? "" ?></p>
                <!--could show the categories of the products here-->
                <!--could show the ingredients of the products here-->
                <div class="form-floating w-50">
                    <input class="form-control" type="number" name="quantity" id="quantity" min="1" max="99" value="1" required>
                    <label for="quantity">Quantity:</label>
                </div>
                <h2>Price: <?= $product->getPrice() ?? 0 ?> €</h2>
                <button type="submit" class="btn btn-primary">Add to cart</button>
            </form>
        </div>
    </div>
</section>