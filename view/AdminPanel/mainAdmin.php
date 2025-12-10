<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/css/admin.css">
    <title>EEATS Admin Panel</title>
</head>

<body class="">

    <!-------------- HEADER ----------------->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid d-flex gap-5 d-flex">
            <a class="navbar-brand" href="http://eeats.com">Home Page</a>
            <div class="d-flex" id="navbarSupportedContent">
                <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0 d-flex gap-4">
                    <li class="nav-item">
                        <a class="btn btn-primary btn-class nav-link " for="Users" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" for="Orders" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" for="Products" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" for="Discounts" href="#">Discounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" for="Ingredients" href="#">Ingredients</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-------------- MAIN CONTENT ----------------->
    <main class="container-fluid px-0 text-center">
        <section id="Users" class="content-section show flex-column justify-content-start">
            <table>
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile_picture</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Premium</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody id="userTableBody">
                    
                </tbody>
            </table>
            <br>
            <br>
            <form action="" class="dataForm">
                <p>Submitting without an id selected will make a new user!</p>
                <label for="">Id</label>
                <p id="userIdDisplay">No Id Selected</p>
                <input type="hidden" name="" id="userId">
                <label for="userName">Name</label><br>
                <input type="text" name="userName" id="userName">
                <br>
                <label for="userEmail">Email</label><br>
                <input type="email" name="" id="userEmail">
                <br>
                <label for="userPFP">Profile Picture file name</label><br>
                <input type="text" name="" id="userPFP">
                <br>
                <label for="userPass">Password</label><br>
                <input type="password" name="" id="userPass">
                <br>
                <label for="userRole">Role</label><br>
                <select name="" id="userRole">
                    <option value="user" id="userNormalRole">User</option>
                    <option value="admin" id="userAdminRole">Admin</option>
                </select>
                <br>
                <label for="userIsPremium">Premium</label><br>
                <input type="checkbox" name="" id="userIsPremium">
                <br>
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </form>
        </section>
        <section id="Orders" class="content-section">
            <p>Orders</p>
        </section>
        <section id="Products" class="content-section">
            <p>Products</p>
        </section>
        <section id="Discounts" class="content-section">
            <p>Discounts</p>
        </section>
        <section id="Ingredients" class="content-section">
            <p>Ingredients</p>
        </section>
        <section id="" class="content-section">
            <p></p>
        </section>
        <section id="" class="content-section">
            <p></p>
        </section>
        <section id="" class="content-section">
            <p></p>
        </section>
        <section id="" class="content-section">
            <p></p>
        </section>
    </main>
</body>
<script src="/resources/js/main.js"></script>
<script src="/resources/js/user.js"></script>
</html>