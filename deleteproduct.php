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

    $deleteproduct = mysqli_query($connect, "DELETE FROM products WHERE id='$productid'");

     if($deleteproduct){
        echo "
            <script>
                alert('Product deleted successfully.');
                window.location.href='products.php';
            </script>
        ";
}
else {
    echo "
        <script>
            alert('Something went wrong. Please try again later.');
            window.location.href='products.php';
        </script>
    ";
}
?>