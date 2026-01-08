<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config/db.php';

// TEMPORARY user id (we'll add login later)
$user_id = $_SESSION['user_id'];


if(empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit();
}

$total = 0;

// 1️⃣ Calculate total price
foreach($_SESSION['cart'] as $food_id => $qty){
    $result = mysqli_query($conn, "SELECT price FROM food_items WHERE id = $food_id");
    $row = mysqli_fetch_assoc($result);
    $total += $row['price'] * $qty;
}

// 2️⃣ Insert into orders table
mysqli_query($conn, "INSERT INTO orders (user_id, total_price) VALUES ($user_id, $total)");
$order_id = mysqli_insert_id($conn);

// 3️⃣ Insert into order_items table
foreach($_SESSION['cart'] as $food_id => $qty){
    mysqli_query(
        $conn,
        "INSERT INTO order_items (order_id, food_id, quantity)
         VALUES ($order_id, $food_id, $qty)"
    );
}

// 4️⃣ Clear cart
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5 text-center">

<h2 class="text-success">✅ Order Placed Successfully!</h2>
<p>Your Order ID: <b>#<?= $order_id ?></b></p>

<a href="menu.php" class="btn btn-primary mt-3">Order More Food</a>

</body>
</html>
