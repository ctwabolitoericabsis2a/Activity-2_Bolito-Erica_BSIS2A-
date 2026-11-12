<?php
    require_once "config.php";
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("Location: index.php");
    exit;
    }
 
    $totaluser = $connect->query("SELECT COUNT(*) AS total from users")->fetch_assoc()['total'];
    $totalpending = $connect->query("SELECT COUNT(*) AS total from users WHERE status='pending'")->fetch_assoc()['total'];
    $totalproduct = $connect->query("SELECT COUNT(*) AS total from products")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <div class="wrap">
            <span class="brand">Shoe Store</span>
            <nav class="nav">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="products.php">Products</a>
                <?php if($_SESSION['role'] === "admin"): ?>
                <a href="users.php">User Management</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
 
    <main class="main wrap">
        <h1>Welcome!</h1>

        <div class="stats">
            <?php if($_SESSION['role'] === "admin"): ?>
            <div class="stat stat-users">
                <span class="stat-label">Total users</span>
                <span class="stat-value"><?php echo $totaluser; ?></span>
            </div>
            <div class="stat stat-pending">
                <span class="stat-label">Not approved</span>
                <span class="stat-value"><?php echo $totalpending; ?></span>
            </div>
            <?php endif; ?>
            <div class="stat stat-products">
                <span class="stat-label">Products</span>
                <span class="stat-value"><?php echo $totalproduct; ?></span>
            </div>
        </div>
    </main>
</body>
</html>