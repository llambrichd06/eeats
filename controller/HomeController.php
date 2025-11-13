<?php
 //La ruta real sera view/home/index.php


class HomeController {
    public function index() {
        $view = 'view/home/home.php';

        include_once 'view/main.php';
    }
    

}