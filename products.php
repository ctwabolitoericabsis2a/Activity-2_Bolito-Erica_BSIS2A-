<?php
    require_once "config.php";
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("Location: index.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <div class="wrap">
            <span class="brand">Shoe Store</span>
            <nav class="nav">
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php" class="active">Products</a>
                <?php if($_SESSION['role'] === "admin"): ?>
                <a href="users.php">User Management</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="main wrap">
        <?php if($_SESSION['role'] === "admin"): ?>
        <div class="panel">
            <h3>Add Product</h3>
            <form action="" method="post" class="product-form">
                <div>
                    <div>
                        <label for="">Product Name:</label>
                        <input type="text" name="product_name" id=""required>
                    </div>
                    <div>
                        <label for="">Description:</label>
                        <textarea name="description" id="" cols="50" rows="5"required></textarea>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="">Quantity:</label>
                        <input type="number" name="quantity" id=""required>
                    </div>
                    <div>
                        <label for="">Price:</label>
                        <input type="number" name="price" id="" step="0.01" required>
                    </div>
                    <div>
                        <input type="submit" value="Add Product" name="addproductbtn">
                    </div>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <div class="panel">
            <h3>Product List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date Saved</th>
                        <?php if($_SESSION['role'] === "admin"): ?>
                        <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $fetchproduct = mysqli_query($connect, "SELECT * FROM products");

                       if (mysqli_num_rows($fetchproduct) > 0) {
                        while ($product = mysqli_fetch_assoc($fetchproduct)) {
                    ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo h($product['name']); ?></td>
                                <td><?php echo h($product['description']); ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['created_at']; ?></td>
                                <?php if($_SESSION['role'] === "admin"): ?>
                                <td>
                                    <button onclick="window.location.href='editproduct.php?productid=<?php echo $product['id']; ?>'">Edit</button>
                                    <button class="btn-danger" onclick="window.location.href='deleteproduct.php?productid=<?php echo $product['id']; ?>'">Delete</button>
                                </td>
                                <?php endif; ?>
                            </tr>
                     <?php
                        }
                       } else {
                        ?>
                            <tr>
                                <td colspan="7">No products found.</td>
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

<?php
    if (isset($_POST['addproductbtn']) && $_SESSION['role'] === "admin") {
        $name = mysqli_real_escape_string($connect, $_POST['product_name']);
        $desc = mysqli_real_escape_string($connect, $_POST['description']);
        $q = mysqli_real_escape_string($connect, $_POST['quantity']);
        $price = mysqli_real_escape_string($connect, $_POST['price']);

        $userid = $_SESSION['user_id'];

        $insertquery = "INSERT INTO products (name, description, quantity, price, created_by) VALUES ('$name', '$desc', '$q', '$price', '$userid')";
        
        $insertfunc = mysqli_query($connect, $insertquery);
        if ($insertfunc) {
            echo "
                <script>
                    alert('Product saved successfully!');
                    window.location.href='products.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Something went wrong. Please try again later!');
                    window.location.href='products.php';
                </script>
            ";
        }
    }
?>