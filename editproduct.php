<?php
    require_once "config.php";
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("Location: index.php");
        exit;
    }

    if($_SESSION['role'] !== "admin"){
        header("Location: products.php");
        exit;
    }
         
    $productid = (int) $_GET['productid'];

    $fetchproduct = mysqli_query($connect, "SELECT * FROM products WHERE id='$productid'");

    if(mysqli_num_rows($fetchproduct) === 0){
        echo "
            <script>
                alert('No product found.');
                window.location.href='products.php';
            </script>
        ";
        exit;
    }
      $product = mysqli_fetch_assoc($fetchproduct);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        <div class="panel">
            <h3>Edit Product ID <?php echo $product['id']; ?></h3>
            <form action="" method="post" class="product-form">
                <div>
                    <div>
                        <label for="">Product Name:</label>
                        <input type="text" name="product_name" id=""required value="<?php echo h($product['name']); ?>">
                    </div>
                    <div>
                        <label for="">Description:</label>
                        <textarea name="description" id="" cols="50" rows="5"required><?php echo h($product['description']); ?></textarea>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="">Quantity:</label>
                        <input type="number" name="quantity" id=""required value="<?php echo h($product['quantity']); ?>">
                    </div>
                    <div>
                        <label for="">Price:</label>
                        <input type="number" name="price" id="" step="0.01" required value="<?php echo h($product['price']); ?>">
                    </div>
                    <div>
                        <input type="submit" value="Save Product" name="savebtn">
                    </div>
                </div>
            </form>
            <p><a class="cancel-link" href="products.php">Cancel</a></p>
        </div>
    </div>
</body>
</html>


<?php
    if (isset($_POST['savebtn'])) {
        $name = mysqli_real_escape_string($connect, $_POST['product_name']);
        $desc = mysqli_real_escape_string($connect, $_POST['description']);
        $q = mysqli_real_escape_string($connect, $_POST['quantity']);
        $price = mysqli_real_escape_string($connect, $_POST['price']);

        $updatequery = "UPDATE products SET name='$name', description='$desc', quantity='$q', price='$price' WHERE id=$productid";
        
        $updatefunc = mysqli_query($connect, $updatequery);
        if ($updatefunc) {
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