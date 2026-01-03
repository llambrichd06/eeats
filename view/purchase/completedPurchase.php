<section class="d-flex flex-column align-items-center justify-content-center py-5">
    <h1>Purchase Completed</h1>
    <p>Thank you for your purchase! Your order number is <b>#<?= $_GET['orderId'] ?></b></p>
    <p>Redirecting...</p>
</section>
<script>
    setTimeout(() => {
        window.location.href = "?controller=Home&action=index";
    }, 4000);
</script>