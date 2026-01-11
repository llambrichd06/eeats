<?php
include_once "model/dao/UserDAO.php";


class UserController
{

    public function showUserPage()
    {
        include_once 'view/startSession.php';
        include_once 'view/authenticator.php';
        $view = 'view/userPanel/userPage.php';

        $user = $_SESSION['user'];
        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: $currentUrl?$loginGetParams");
        }
        include_once 'view/main.php';
    }
}
