<?php
include 'config/db.php';
$result = mysqli_query($conn, "SELECT * FROM food_items");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Canteen Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="container mt-4">

<h2 class="text-center mb-4">🍽️ College Canteen Menu</h2>

<div class="row">
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
    <img src="assets/images/<?= $row['image'] ?>"
         class="card-img-top"
         height="180"
         alt="<?= $row['food_name'] ?>">

    <div class="card-body text-center">
        <h5><?= $row['food_name'] ?></h5>
        <p class="text-muted">₹<?= $row['price'] ?></p>

        <a href="add_to_cart.php?id=<?= $row['id'] ?>"
           class="btn btn-success w-100">
            Add to Cart
        </a>
    </div>
</div>

    </div>
<?php } ?>
</div>

<a href="cart.php" class="btn btn-warning mt-4">View Cart</a>

</body>
</html>
