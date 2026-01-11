<?php
include_once "model/dao/UserDAO.php";



class SessionController
{

    public function showLogin()
    {
        include_once 'view/startSession.php';
        $view = 'view/userSession/userLogin.php';

        $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
        $homeGetParams = http_build_query([ //turn an object into get parameters, in this case this returns "controller=Home&action=index"
            'controller' => 'Home',
            'action' => 'index'
        ]);
        if ($userLoggedIn) {
            header("Location: $currentUrl?$homeGetParams");
        }
        $loginResult = "";
        if (isset($_POST["logEmail"], $_POST["logPass"])) {
            $email = $_POST["logEmail"];
            $pass = $_POST["logPass"];
            $user = UserDAO::getUserByEmail($email);
            if ($user) {
                if (password_verify($pass, $user->getPassword())) {
                    $_SESSION["user"] = $user->toArray();
                    header("Location: $currentUrl?$homeGetParams");
                    exit;
                }
            }
            $loginResult = "The submitted email or password is incorrect.";
        }
        include_once 'view/main.php';
    }

    public function showSignUp()
    {
        include_once 'view/startSession.php';
        $view = 'view/userSession/userSignUp.php';
        
        $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
        $loginGetParams = http_build_query([ //turn an object into get parameters, in this case this returns "controller=Session&action=showLogin"
            'controller' => 'Session',
            'action' => 'showLogin'
        ]);
        if ($userLoggedIn) {
            header("Location: $currentUrl?$loginGetParams");
        }
        $signUpResult = "";
        if (isset($_POST["signEmail"], $_POST["signPass"], $_POST["signName"])) {
            $email = $_POST["signEmail"];
            $pass = $_POST["signPass"];
            $name = $_POST["signName"];

            unset($_POST);
            $userExist = UserDAO::getUserByEmail($email);
            if ($userExist) {
                $signUpResult = "The submitted email is already registered.";
            } else {
                $user = new User;
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $user->setData($name, $email, "Unset", $pass, 'user', 0);
                $return = UserDAO::saveUser($user);
                header("Location: $currentUrl?$loginGetParams");
            }
        }
        include_once 'view/main.php';
    }
}
