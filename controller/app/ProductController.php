<?php
include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";



class ProductController
{

    public function showProduct()
    {
        include_once 'view/startSession.php';
        include_once 'view/authenticator.php';
        $view = 'view/products/individualProduct.php';
        $idProduct = $_GET['idProduct'];
        $product = ProductDAO::getProductByID($idProduct);
        $discount = 0;
        if ($product->getDiscountId()) {
            $discount = DiscountDAO::getDiscountById($product->getDiscountId());
        }
        if (isset($_POST['addedProdId'], $_POST['quantity'])) {
            $prodId = $_POST['addedProdId'];
            $quantity = $_POST['quantity'];
            $cartProduct = [ //NEED TO ADD INGREDIENTS HERE LATER ON
                'product_id' => $prodId,
                'quantity' => $quantity,
                /*'ingredients' => [
            'removed' => $removedIng
            'added' => $addedIng
        ]*/
            ];
            array_push($_SESSION['cart'], $cartProduct);
            unset($_POST);
        }
        include_once 'view/main.php';
    }

    public function showProductPage()
    {
        include_once 'view/startSession.php';
        $view = 'view/products/productsPage.php';
        $products = ProductDAO::getProducts();
        include_once 'view/main.php';
    }
}
