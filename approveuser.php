<?php
require_once "config.php";

if (!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])) {
    header("location: index.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("location: dashboard.php");
    exit;
}

$userId = (int) $_GET['userid'];

$approveuser = mysqli_query($connect, "UPDATE users SET status = 'approved' WHERE id = '$userId'");

if ($approveuser) {
    echo "
        <script>
        alert('User is approved');

        window.location.href='users.php';
        </script>
    ";
} else {
    echo "
        <script>
        alert('Something went wrong. Please try again later.');

        window.location.href='users.php';
        </script>
    ";
}
?>