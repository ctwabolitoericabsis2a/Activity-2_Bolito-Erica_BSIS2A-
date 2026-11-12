<?php
    require_once "config.php";


    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $uname = $_POST['uname'];
        $password = $_POST['password'];

        $stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();
       
        $user = $result->fetch_assoc();

        $stmt->close();
        if($user && password_verify ($password, $user['password'])){
            if($user['status']!== "approved"){
                $errors[] = "Your account is not approved.";
            }else{
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: dashboard.php");

                exit;
            }
        }else {
            $errors[] = "Invalid username or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
    <h1>Shoe Store</h1>
    <h2>Sign In to your account</h2>
    <br>
    <?php foreach ($errors as $e): ?>
        <p class="notification" style="color:red;"><?= h($e) ?></p>
        <?php endforeach; ?>


    <form action="" method="POST">
        <label for="Username">Username:</label>
        <input type="text" name="uname" id="" placeholder="Enter your username" required autofocus>
        <br><br>
        <label for="Password">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter your password" required>
        <br><br>
        <input type="submit" value="Sign In">
    </form>
        <br><br>

         <p>No Account yet? <a href="register.php">Register</a></p>
            
<script>
            function togglePassword(id, showR) {
                const newPass = document.getElementById(id);

                if (newPass.type === "password") {
                    newPass.type = "text";
                    showR.innerHTML = "Hide password";
                } else {
                    newPass.type = "password";
                    showR.innerHTML = "Show password";
                }
            }

            setTimeout(() => {
                document.querySelectorAll('.notification').forEach(notification => {
                    notification.style.display = 'none';
                });
            }, 3000);
        </script>
</body>
</html>