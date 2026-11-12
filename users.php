<?php
    require_once "config.php";
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("Location: index.php");
        exit;
    }
         
    if($_SESSION['role'] !== "admin"){
        header("Location: dashboard.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <div class="wrap">
            <span class="brand">Shoe Store</span>
            <nav class="nav">
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php">Products</a>
                <?php if($_SESSION['role'] === "admin"): ?>
                <a href="users.php" class="active">User Management</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="main wrap">
        <h1> User Management</h1>
        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $fetchquery = ("SELECT * FROM users");

                       $fetch = mysqli_query($connect, $fetchquery);

                       if(mysqli_num_rows($fetch) > 0){
                            while($user = mysqli_fetch_assoc($fetch)){
                        ?>
                             <tr>
                                    <td><?php echo h($user['username']); ?></td>
                                    <td class="status-<?php echo h($user['status']); ?>"><?php echo h($user['status']); ?></td>
                                    <td><?php echo h($user['role']); ?></td>
                                    <td><?php echo $user['created_at']; ?></td>
                                    <td> 
                                        <?php if($user['status'] !== 'approved'): ?>
                                        <button onclick="window.location.href='approveuser.php?userid=<?php echo $user['id']; ?>'">Approve</button>
                                        <?php elseif($user['status'] === 'approved'): ?>
                                        <button class="btn-danger" onclick="window.location.href='disableuser.php?userid=<?php echo $user['id']; ?>'">Disable</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php
                            }
                       }
                       else{
                    ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                        <?php
                       }
                    ?>
                
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>