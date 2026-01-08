<?php
include '../config/db.php';

/* Function to decide badge color based on status */
function statusColor($status){
    if($status == "Pending") return "warning";
    if($status == "Preparing") return "info";
    if($status == "Ready") return "success";
    if($status == "Completed") return "secondary";
    return "dark";
}

/* Fetch all orders */
$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Canteen Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="container mt-4">

<h2 class="text-center mb-4">🍳 Canteen Orders Dashboard</h2>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Order ID</th>
            <th>Total (₹)</th>
            <th>Status</th>
            <th>Order Time</th>
            <th>Update Status</th>
        </tr>
    </thead>

    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <!-- Highlight READY orders -->
        <tr class="<?= ($row['status'] == 'Ready') ? 'table-success' : '' ?>">

            <td>#<?= $row['id'] ?></td>

            <td>₹<?= $row['total_price'] ?></td>

            <td>
                <span class="badge bg-<?= statusColor($row['status']) ?>">
                    <?= $row['status'] ?>
                </span>

                <?php if($row['status'] == "Ready"){ ?>
                    <div class="text-success small mt-1">
                        ✔ Ready for pickup
                    </div>
                <?php } ?>
            </td>

            <td><?= $row['order_time'] ?></td>

            <td>
                <form action="update_status.php" method="post" class="d-flex gap-2">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">

                    <select name="status" class="form-select form-select-sm">
                        <option <?= ($row['status']=="Pending")?'selected':'' ?>>Pending</option>
                        <option <?= ($row['status']=="Preparing")?'selected':'' ?>>Preparing</option>
                        <option <?= ($row['status']=="Ready")?'selected':'' ?>>Ready</option>
                        <option <?= ($row['status']=="Completed")?'selected':'' ?>>Completed</option>
                    </select>

                    <button class="btn btn-primary btn-sm">Update</button>
                </form>
            </td>

        </tr>

    <?php } ?>
    </tbody>
</table>

</body>
</html>
