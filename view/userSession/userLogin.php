<?php
    $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
    $query = http_build_query([ //turn an object into get parameters, in this case this returns "controller=home&action=index"
        'controller' => 'home',
        'action' => 'index'
    ]);
    if ($userLoggedIn) {
        header("Location: $currentUrl?$query");
    }
    $loginResult = "";
    if (isset($_POST["logEmail"], $_POST["logPass"])) {
        $email = $_POST["logEmail"];
        $pass = $_POST["logPass"];
        unset($_POST);
        $user = UserDAO::getUserByEmail($email);
        if ($user) {
            if ($user->getPassword() == $pass) {
                $_SESSION["user"] = $user->toArray();
                $_SESSION["user"]["password"] = "";
                header("Location: $currentUrl?$query");
                exit;
            }
        }
        $loginResult = "The submitted email or password are incorrect.";
    }
?>
<div class="d-flex flex-column align-items-center justify-content-center">
    <h1>User Login</h1>

    <form action="" method="post" class="d-flex flex-column align-items-center justify-content-center">
        <label for="logEmail">User Email</label>
        <input type="email" name="logEmail" id="logEmail" required>
        <label for="logPass">Password</label>
        <input type="password" name="logPass" id="logPass" required> 
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p><?=$loginResult?></p>
</div>