<?php
include 'config/db.php';

// TEMP user id (until login system)
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header("Location: login.php");
    exit();
}


// Fetch orders of this student
$result = mysqli_query(
    $conn,
    "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="container mt-4">

<h2 class="text-center mb-4">📦 My Orders</h2>

<?php if(mysqli_num_rows($result) > 0) { ?>
<table class="table table-bordered table-striped">
    <tr>
        <th>Order ID</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Order Time</th>
    </tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td>#<?= $row['id'] ?></td>
        <td>₹<?= $row['total_price'] ?></td>
        <td>
            <?php
            $status = $row['status'];
            $color = "secondary";
            if($status == "Pending") $color = "warning";
            if($status == "Preparing") $color = "info";
            if($status == "Ready") $color = "success";
            if($status == "Completed") $color = "dark";
            ?>
            <span class="badge bg-<?= $color ?>">
        <?= $status ?>
    </span>

    <?php if($status == "Ready"){ ?>
        <div class="text-success small mt-1">
            ✔ Please collect your order
        </div>
    <?php } ?>

    <?php if($status == "Preparing"){ ?>
        <div class="text-info small mt-1">
            ⏳ Your food is being prepared
        </div>
    <?php } ?>
        </td>
        <td><?= $row['order_time'] ?></td>
    </tr>
<?php } ?>

</table>
<?php } else { ?>
<p class="text-center">You have not placed any orders yet.</p>
<?php } ?>

<a href="menu.php" class="btn btn-secondary mt-3">⬅ Back to Menu</a>

</body>
</html>
