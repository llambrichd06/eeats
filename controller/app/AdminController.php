<?php
include_once "model/dao/UserDAO.php";


class AdminController
{

    public function showLogin()
    {
        include_once 'view/startSession.php';
        $loginResult = "";
        $adminMsg = false;
        if (isset($_POST["logEmail"], $_POST["logPass"])) {
            $email = $_POST["logEmail"];
            $pass = $_POST["logPass"];
            unset($_POST);
            $user = UserDAO::getUserByEmail($email);
            if ($user) {
                if (password_verify($pass, $user->getPassword())) {
                    if ($user->getRole() == "admin") {
                        setcookie("adminVerified", true, time() + 600); //set a cookie to know that the admin is logged in for 5 minutes
                        $_SESSION['lastAdminLoginId'] = $user->getId(); //set a session variable to know the id of the last admin that logged in for the logs
                        $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
                        $panelGetParams = http_build_query([ //turn an object into get parameters
                            'controller' => 'Admin',
                            'action' => 'showPanel'
                        ]);
                        header("Location: $currentUrl?$panelGetParams");
                    } else {
                        $loginResult = "The user doesen't have admin privileges.";
                        $adminMsg = true;
                    }
                }
            }
            if (!$adminMsg) {
                $loginResult = "The submitted email or password is incorrect.";
            }
        }
        $view = 'view/adminPanel/adminLogin.php';
        include_once 'view/main.php';
    }

    public function showPanel()
    {
        if (!isset($_COOKIE['adminVerified'])) {
            header('Location: ?controller=Admin&action=showLogin');
        }
        include_once 'view/adminPanel/mainAdmin.php';
    }
}
