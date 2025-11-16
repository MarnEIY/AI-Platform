<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = clean_input($_POST['full_name']);
    
    if (strlen($username) < 4) {
        $error = "Username minimal 4 karakter!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } elseif ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid!";
    } else {

        $check_stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $error = "Username atau Email sudah terdaftar!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("ssss", $username, $email, $hashed_password, $full_name);
            
            if ($insert_stmt->execute()) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Terjadi kesalahan. Silakan coba lagi.";
            }
            
            $insert_stmt->close();
        }
        
        $check_stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | AI PLATFORM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <img class="image-gradient" src="gradient.png" alt="gradient">
    <div class="layer-blur"></div>

    <div class="login-container">
        <h1 class="login-title">Create Account</h1>

        <?php if ($error): ?>
            <div style="background-color: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div style="background-color: #44ff44; color: black; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST" class="login-form">
            <input type="text" name="full_name" placeholder="Full Name" class="login-input" required>
            <input type="text" name="username" placeholder="Username" class="login-input" required>
            <input type="email" name="email" placeholder="Email" class="login-input" required>
            <input type="password" name="password" placeholder="Password (min 6 characters)" class="login-input" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" class="login-input" required>

            <button type="submit" class="login-btn">Register</button>
        </form>

        <div class="login-divider">Already have an account?</div>

        <div class="login-social">
            <a href="index.php" class="social-btn">Login Here</a>
        </div>
    </div>

</body>
</html>