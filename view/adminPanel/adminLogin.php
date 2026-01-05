<?php

    $loginResult = "";
    $adminMsg = false;
    if (isset($_POST["logEmail"], $_POST["logPass"])) {
        $email = $_POST["logEmail"];
        $pass = $_POST["logPass"];
        unset($_POST);
        $user = UserDAO::getUserByEmail($email);
        if ($user) {
            if ($user->getPassword() == $pass) {
                if ($user->getRole() == "admin") {
                    setcookie("adminVerified", true, time() + 600); //set a cookie to know that the admin is logged in for 5 minutes
                    $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
                    $panelGetParams = http_build_query([ //turn an object into get parameters
                        'controller' => 'Admin',
                        'action' => 'showPanel'
                    ]);
                    header("Location: $currentUrl?$panelGetParams");
                } else {
                    $loginResult = "You do not have admin privileges.";
                    $adminMsg = true;
                }
            }
        }
        if ($adminMsg) {
            $loginResult = "The submitted email or password is incorrect.";
        }
    }
?>
<div class="d-flex flex-column align-items-center gap-5 justify-content-center">
    <h1>Admin Login</h1>

    <form action="" method="post" class="d-flex flex-column align-items-center justify-content-center gap-5 loginform">
        <div class="form-floating w-100">
            <input type="email" class="form-control" id="logEmail" name="logEmail" placeholder="name@example.com" required>
            <label for="logEmail">Email address *</label>
        </div>
        <div class="form-floating w-100">
            <input type="password" class="form-control" id="logPass" name="logPass" placeholder="password1234" required>
            <label for="logPass">Password *</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p><?=$loginResult?></p>
    
</div>