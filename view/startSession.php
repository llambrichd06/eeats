<?php
session_start();
$userLoggedIn = isset($_SESSION['user']);
if ($userLoggedIn && !isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}