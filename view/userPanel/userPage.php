<section class="margin my-5">
    <h1 class="mb-4">Welcome back, <?= htmlspecialchars($user['name']) ?> 👋</h1>

    <div class="row justify-content-center">
        <!-- user card -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="mb-4">Your Profile</h2>

                    <div class="row text-start">
                        <div class="col-6">
                            <strong>Name</strong>
                            <p class="mb-0"><?= htmlspecialchars($user['name']) ?></p>
                        </div>

                        <div class="col-6">
                            <strong>Email</strong>
                            <p class="mb-0"><?= htmlspecialchars($user['email']) ?></p>
                        </div>

                        <div class="col-12">
                            <strong class="mb-0 pb-0">User code</strong>
                            <p class="mb-0"><?= $user['id'] ?></p>
                            <p class="mb-0"><small>(If you need support, an admin might need this!)</small></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- actions card (its really only logout) -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="mb-3">Account Actions</h2>
                        <p class="text-muted">Sign out safely.</p>
                    </div>

                    <form action="" method="post" class="mt-4">
                        <button type="submit" class="btn btn-danger w-100" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
