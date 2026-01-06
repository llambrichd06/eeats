<?php
if (!isset($_COOKIE['adminVerified'])) {
    header('Location: ?controller=Admin&action=showLogin');
}
?>
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
                        <a class="nav-link btn" for="Logs" href="#">Logs</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex w-100 justify-content-center align-items-center py-3" id="currencySelector">
        <p class="m-0 pe-2">Currency selector</p>
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
            <form action="" id="userForm">
                <p>Submitting without an id selected will make a new user!</p>
                <label for="">Id</label>
                <p id="userIdDisplay">No Id Selected</p>
                <input type="hidden" name="" id="userId">
                <label for="userName">Name</label><br>
                <input type="text" name="userName" id="userName" required>
                <br>
                <label for="userEmail">Email</label><br>
                <input type="email" name="" id="userEmail" required>
                <br>
                <label for="userPFP">Profile Picture file name</label><br>
                <input type="text" name="" id="userPFP">
                <br>
                <label for="userPass">Password</label><br>
                <input type="password" name="" id="userPass" required>
                <br>
                <label for="userRole">Role</label><br>
                <select name="" id="userRole" required>
                    <option value="user" id="userNormalRole">User</option>
                    <option value="admin" id="userAdminRole">Admin</option>
                </select>
                <br>
                <label for="userIsPremium">Premium</label><br>
                <input type="checkbox" name="" id="userIsPremium">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </section>
        <section id="Orders" class="content-section flex-column justify-content-start">
            <div class="orderFilters">
                <select name="" id="orderFilter">
                    <option value="">Filter data by:</option>
                    <option value="user">User Id</option>
                    <option value="date">Delivery Date</option>
                    <option value="no_date">No delivery date</option>
                    <option value="price">Higher than Price</option>
                </select>
                <input type="number" name="" id="" class="filterInput">
                <input type="datetime-local" name="" id="" class="filterInput">
                <select name="" id="orderSort">
                    <option value="">Sort data by:</option>
                    <option value="user">User Id</option>
                    <option value="date">Delivery Date</option>
                    <option value="price">Price</option>
                </select>
                <select name="" id="sortingOrder">
                    <option value="asc">ASC</option>
                    <option value="desc">DESC</option>
                </select>
                <button id="filterButton" class="btn btn-secondary">Set filter settings</button>
                <br>
                <p>Set the filters to their default values to reset them!</p>
            </div>
            <table>
                <thead>
                    <th>Id</th>
                    <th>UserId</th>
                    <th>CreatedAt</th>
                    <th>Address</th>
                    <th>DeliveryType</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>DeliveryDate</th>
                    <th>DiscountId</th>
                    <th>DiscountApplied</th>
                    <th>Order Lines</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody id="orderTableBody">

                </tbody>
            </table>
            <br>
            <br>
            <form action="" class="orderForm">
                <p>Submitting without an id selected will make a new order!</p>
                <label for="">Id</label>
                <p id="orderIdDisplay">No order Selected</p>
                <input type="hidden" name="" id="orderId">
                <label for="orderUserId">User id</label><br>
                <input type="number" name="" id="orderUserId">
                <br>
                <label for="orderCreatedAt">Created at</label><br>
                <input type="text" name="" id="orderCreatedAt" disabled>
                <br>
                <label for="orderAddress">Order Address</label><br>
                <input type="text" name="" id="orderAddress">
                <br>
                <label for="orderDeliveryType">Delivery Type</label><br>
                <select name="" id="orderDeliveryType">
                    <option value="pickup" id="orderPickupDeliveryType">Pickup</option>
                    <option value="delivery" id="orderDeliveryDeliveryType">Delivery</option>
                </select>
                <br>
                <label for="orderSubtotal">Subtotal</label><br>
                <input type="number" name="" id="orderSubtotal" required>
                <br>
                <label for="orderTotal">Total</label><br>
                <input type="number" name="" id="orderTotal">
                <br>
                <label for="orderDeliveryDate">Delivery Date</label><br>
                <input type="datetime-local" name="" id="orderDeliveryDate" required>
                <br>
                <label for="orderIdDiscount">Related Discount Id</label><br>
                <input type="number" name="" id="orderDiscountId">
                <br>
                <label for="orderDiscountAmount">Amount discounted</label><br>
                <input type="number" name="" id="orderDiscountAmount">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </section>
        <section id="Products" class="content-section flex-column justify-content-start">
            <table>
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created_at</th>
                    <th>Stock</th>
                    <th>Img</th>
                    <th>Premium</th>
                    <th>Discount_id</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody id="prodTableBody">

                </tbody>
            </table>
            <br>
            <br>
            <form action="" id="prodForm">
                <p>Submitting without an id selected will make a new prod!</p>
                <label for="">Id</label>
                <p id="prodIdDisplay">No Id Selected</p>
                <input type="hidden" name="" id="prodId">
                <label for="prodName">Name</label><br>
                <input type="text" name="prodName" id="prodName" required>
                <br>
                <label for="prodDesc">Description</label><br>
                <textarea name="" id="prodDesc" required></textarea>
                <br>
                <label for="prodPrice">Price</label><br>
                <input type="number" name="" id="prodPrice" required>
                <br>
                <label for="prodCreatedAt">Created at</label><br>
                <input type="datetime" name="" id="prodCreatedAt" required disabled>
                <br>
                <label for="prodStock">Stock</label><br>
                <input type="text" name="" id="prodStock" required>
                <br>
                <label for="prodImg">Image File Name</label><br>
                <input type="text" name="" id="prodImg" required>
                <br>
                <label for="prodIsPremium">Premium</label><br>
                <input type="checkbox" name="" id="prodIsPremium">
                <br>
                <label for="prodDiscountId">Related Discount Id</label><br>
                <input type="number" name="" id="prodDiscountId">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </section>
        <section id="Discounts" class="content-section flex-column justify-content-start">
            <table>
                <thead>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Percent</th>
                    <th>Uses</th>
                    <th>Begins At</th>
                    <th>Ends At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody id="discountTableBody">

                </tbody>
            </table>
            <br>
            <br>
            <form action="" id="discountForm">
                <p>Submitting without an id selected will create a new discount!</p>

                <!-- Discount ID (hidden) -->
                <label for="">Id</label>
                <p id="discountIdDisplay">No Id Selected</p>
                <input type="hidden" name="" id="discountId">

                <!-- Discount Code -->
                <label for="discountCode">Code</label><br>
                <input type="text" name="discountCode" id="discountCode">
                <br>

                <!-- Discount Type -->
                <label for="discountType">Type</label><br>
                <select name="discountType" id="discountType" required>
                    <option value="0" id="discountCodeType">Code-based discount</option>
                    <option value="1" id="discountProductType">Product automatic discount</option>
                </select>
                <br>

                <!-- Discount Percent -->
                <label for="discountPercent">Percent (%)</label><br>
                <input type="number" name="discountPercent" id="discountPercent" min="0" max="100" required>
                <br>

                <!-- Discount Uses -->
                <label for="discountUses">Uses</label><br>
                <input type="number" name="discountUses" id="discountUses" min="0">
                <br>

                <!-- Begins At -->
                <label for="discountBeginsAt">Begins At</label><br>
                <input type="datetime-local" name="discountBeginsAt" id="discountBeginsAt" required>
                <br>

                <!-- Ends At -->
                <label for="discountEndsAt">Ends At</label><br>
                <input type="datetime-local" name="discountEndsAt" id="discountEndsAt" required>
                <br>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>

        </section>
        <section id="Logs" class="content-section flex-column justify-content-start">
            <table>
                <thead>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>Log date</th>
                    <th>Action</th>
                </thead>
                <tbody id="logTableBody">

                </tbody>
            </table>
            <br>
            <button id="logReload" class="btn btn-primary">Reload Logs</button>
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
    <!-------------- ORDER LINES MODAL ----------------->
    <!-- Overlay -->
    <div id="overlay"></div>

    <!-- Modal -->
    <div id="modal" class="flex-column justify-content-center">
        <div id="modal-header">
            <h2>Order lines for the selected order</h2>
        </div>

        <div id="modal-body">
            <table>
            <thead>
                <th>Id</th>
                <th>Line #</th>
                <th>Order Id</th>
                <th>Product Id</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Edit</th>
            </thead>
            <tbody id="orderLinesTableBody">

            </tbody>
        </table>
        <br>
        <br>
        <form action="" id="orderLinesForm">
            <p>Submitting while specifying a non existing line will create a new order line!</p>

            <label for="">Id</label>
            <p id="orderLineIdDisplay">No Id Selected</p>
            <input type="hidden" id="orderLineId">

            <label for="orderLineNumber">Line #</label><br>
            <input type="number" id="orderLineNumber" min="1" required>
            <br>

            <label for="">Order Id</label><br>
            <p id="orderLineOrderIdDisplay">No Id Selected</p>
            <input type="hidden" id="orderLineOrderId">
            <br>

            <label for="orderLineProductId">Product Id</label><br>
            <input type="number" id="orderLineProductId" min="1" required>
            <br>

            <label for="orderLinePrice">Price</label><br>
            <input type="number" step="0.01" id="orderLinePrice" min="0" required>
            <br>

            <label for="orderLineQuantity">Quantity</label><br>
            <input type="number" id="orderLineQuantity" min="1" required>
            <br>
            <label for="orderLineIsEditing">Edit existing line?</label>
            <input type="checkbox" id="orderLineIsEditing">
            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
        <br>
        <button id="closeOrderLinesBtn" class="btn btn-danger">Close</button>
        </div>
        
    </div>
</body>
<script src="/resources/js/apiConfig.js"></script>
<script src="/resources/js/main.js"></script>
<script src="/resources/js/users.js"></script>
<script src="/resources/js/products.js"></script>
<script src="/resources/js/orders.js"></script>
<script src="/resources/js/discounts.js"></script>
<script src="/resources/js/logs.js"></script>

</html>