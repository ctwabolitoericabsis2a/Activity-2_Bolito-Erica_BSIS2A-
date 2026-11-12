<?php
    require_once "config.php";
$mess = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'] ?? '';

        if ($password === $password2) {
            $check = $connect->prepare("SELECT id FROM users WHERE username = ?");
            $check->bind_param('s', $uname);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                $errors[] = "Username is already taken.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $connect->prepare(
                    "INSERT INTO users (username, password) VALUES (?, ?)"
                );
                $stmt->bind_param('ss', $uname, $hashedPassword);

                if ($stmt->execute()) {
                    $mess[] = "Registered successfully. Please wait for an admin to activate your account.";
                } else {
                    $errors[] = "Something went wrong. Please try again later.";
                }

                
                
                $stmt->close();
            }

            $check->close();
        } else {
            $errors[] = "Passwords do not match.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <h1>Shoe Store</h1>
        <h2>Create an Account</h2>
        <br>
    <?php foreach ($mess as $m): ?>
        <p class="notification" style="color:green;"><?= h($m) ?></p>
        <?php endforeach ?>


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

        <label for="Re-enter Password">Confirm Password:</label>
        <input type="password" name="password2" id="password2" placeholder="Confirm your password" required>
        <br><br>
        <input type="submit" value="Register">
    </form>
        <br><br>

         <p>Already have an account? <a href="index.php">Sign In</a></p>

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