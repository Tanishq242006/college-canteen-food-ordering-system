<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>College Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="container mt-5 text-center">

<h1 class="mb-4">🍽️ College Canteen Food Ordering</h1>

<?php if(isset($_SESSION['user_id'])) { ?>
    <p>Welcome, <b><?= $_SESSION['user_name'] ?></b></p>
    <a href="menu.php" class="btn btn-success m-2">Order Food</a>
    <a href="my_orders.php" class="btn btn-primary m-2">My Orders</a>
    <a href="logout.php" class="btn btn-danger m-2">Logout</a>
<?php } else { ?>
    <a href="login.php" class="btn btn-primary m-2">Login</a>
    <a href="register.php" class="btn btn-success m-2">Register</a>
<?php } ?>
<hr class="my-4">

<h5 class="mt-3">📱 Scan QR Code to Order Food</h5>

<img src="assets/images/menu_qr.png"
     alt="Menu QR Code"
     width="160"
     class="mt-2 shadow">


</body>
</html>
