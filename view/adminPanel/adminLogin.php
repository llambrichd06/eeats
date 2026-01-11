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