<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: AIplatform.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'config.php';
    
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT user_id, username, password, full_name FROM users WHERE username = ? AND is_active = 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            
            $update_stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?");
            $update_stmt->bind_param("i", $user['user_id']);
            $update_stmt->execute();
            
            header("Location: AIplatform.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AI PLATFORM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <img class="image-gradient" src="gradient.png" alt="gradient">
    <div class="layer-blur"></div>

    <div class="login-container">
        <h1 class="login-title">Welcome Back</h1>

        <?php if ($error): ?>
            <div style="background-color: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="login-form">
            <input type="text" name="username" placeholder="Username" class="login-input" required>
            <input type="password" name="password" placeholder="Password" class="login-input" required>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="login-divider">Or continue with</div>

        <div class="login-social">
            <a href="register.php" class="social-btn">Create New Account</a>
        </div>
    </div>

</body>
</html>