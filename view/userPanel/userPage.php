<?php
    include_once 'view/authenticator.php';
    $user = $_SESSION['user'];
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: $currentUrl?$loginGetParams");
    }
?>

<section class="margin">
    <h1 class="mb-3">Welcome, <?= $user['name'] ?>!</h1>
    <div class="d-flex mb-5">
        <div class="row g-0 w-50">
            <h2 class="mb-5 col-12">User data:</h2>
            <p class="col-6">Id: <?= $user['id'] ?></p>
            <p class="col-6">Name: <?= $user['name'] ?></p>
            <p class="col-6">Email: <?= $user['email'] ?></p>
            <p class="col-6">Role: <?= $user['role'] ?></p>
        </div>
        <div class="d-flex align-content-center justify-content-center w-50">
            <form action="" method="post" class="py-5">
                <button type="submit" class="btn btn-danger" name="logout">Logout</button>
            </form>
        </div>
    </div>
</section>