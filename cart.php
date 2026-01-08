<?php
session_start();
include 'config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="container mt-4">

<h2 class="text-center">🛒 Your Cart</h2>

<?php
$total = 0;

if(!empty($_SESSION['cart'])) {
?>
<table class="table table-bordered mt-3">
<tr>
    <th>Food Item</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php
foreach($_SESSION['cart'] as $id => $qty) {
    $result = mysqli_query($conn, "SELECT * FROM food_items WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    $itemTotal = $row['price'] * $qty;
    $total += $itemTotal;
?>
<tr>
    <td><?= $row['food_name'] ?></td>
    <td>₹<?= $row['price'] ?></td>
    <td><?= $qty ?></td>
    <td>₹<?= $itemTotal ?></td>
    <td>
        <a href="remove_from_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">
            Remove
        </a>
    </td>
</tr>
<?php } ?>

<tr>
    <th colspan="3" class="text-end">Grand Total</th>
    <th>₹<?= $total ?></th>
    <th></th>
</tr>
</table>

<a href="place_order.php" class="btn btn-success">Place Order</a>

<?php
} else {
    echo "<p class='text-center mt-4'>Your cart is empty 😔</p>";
}
?>

<a href="menu.php" class="btn btn-secondary mt-3">⬅ Back to Menu</a>

</body>
</html>
