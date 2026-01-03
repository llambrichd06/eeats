<?php
    $currentUrl = $_SERVER['PHP_SELF']; //grab the current url we are in, without get parameters
    $loginGetParams = http_build_query([ //turn an object into get parameters, in this case this returns "controller=Session&action=showLogin"
        'controller' => 'Session',
        'action' => 'showLogin'
    ]);
    if (!$userLoggedIn) {
        header("Location: $currentUrl?$loginGetParams"); //if the user is not logged in, redirect to login page
    }
?>