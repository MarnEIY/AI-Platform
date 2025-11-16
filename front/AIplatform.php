<?php
session_start();
require_once 'config.php';

require_login();

$user_name = $_SESSION['full_name'] ?? $_SESSION['username'];

$user_id = $_SESSION['user_id'];
$page_name = 'home';
$ip_address = $_SERVER['REMOTE_ADDR'];
$track_stmt = $conn->prepare("INSERT INTO page_views (user_id, page_name, ip_address) VALUES (?, ?, ?)");
$track_stmt->bind_param("iss", $user_id, $page_name, $ip_address);
$track_stmt->execute();
$track_stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI PLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <img class="image-gradient" src="gradient.png" alt="gradient">
    <div class="layer-blur"></div>

    <div class="container">
        <header>
            <h1 data-aos="fade-down" data-aos-duration="1500" class="logo">AI PLATFORM</h1>

            <nav>
                <a data-aos="fade-down" data-aos-duration="1500" href="howitworks.php">HOW IT WORKS</a>
                <a data-aos="fade-down" data-aos-duration="2000" href="applications.php">APPLICATIONS</a>
                <a data-aos="fade-down" data-aos-duration="2500" href="futureofai.php">FUTURE OF AI</a>
                <a data-aos="fade-down" data-aos-duration="3000" href="aboutus.php">ABOUT US</a>
                <a data-aos="fade-down" data-aos-duration="3000" href="logout.php" style="color: #ff4444;">LOGOUT</a>
            </nav>

        </header>

        <main>
        <div class="content">
            <div data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300"
            data-aos-offset="0" data-aos-duration="1500" class="tag-box">
                <div class="tag">WELCOME, <?php echo strtoupper(htmlspecialchars($user_name)); ?></div>
            </div>

            <h1 data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300"
            data-aos-offset="0" data-aos-duration="2000" >WHERE INNOVATION <br> MEETS INTELLIGENCE</h1>

            <p data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300"
            data-aos-offset="0" data-aos-duration="2500" class="description">
                education and exploration of artificial intelligence technology designed to introduce the concepts, applications, and future of AI in various fields
            </p>
        </div>
        </main>

        <spline-viewer data-aos="fade-zoom-in"
     data-aos-easing="ease-in-back"
     data-aos-delay="300"
     data-aos-offset="0" data-aos-duration="3000" class="robot-3d" url="https://prod.spline.design/Qf3QUKSifIRchPJq/scene.splinecode"></spline-viewer>

    </div>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.99/build/spline-viewer.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>