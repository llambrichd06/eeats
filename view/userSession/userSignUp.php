<?php
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
?>
<div class="d-flex flex-column align-items-center gap-5 justify-content-center">
    <h1>User Sign Up</h1>

    <form action="" method="post" class="d-flex flex-column align-items-center justify-content-center gap-5 loginform">
        <div class="form-floating w-100">
            <input type="text" class="form-control" id="signName" name="signName" placeholder="John Doe" required>
            <label for="signName">User name *</label>
        </div>
        <div class="form-floating w-100">
            <input type="email" class="form-control" id="signEmail" name="signEmail" placeholder="johndoe@example.com" required>
            <label for="signEmail">Email address *</label>
        </div>
        <div class="form-floating w-100">
            <input type="password" class="form-control" id="signPass" name="signPass" placeholder="password1234" required>
            <label for="signPass">Password *</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
    <p><?=$signUpResult?></p>
</div>