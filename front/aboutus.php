<?php
session_start();
require_once 'config.php';
require_login();

$user_id = $_SESSION['user_id'];
$page_name = 'howitworks';
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
  <title>How It Works | AI PLATFORM</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
  <img class="image-gradient" src="gradient.png" alt="gradient">
  <div class="layer-blur"></div>

  <div class="container">
    <header>
      <a href="AIplatform.php" style="text-decoration: none; color: inherit;">
        <h1 data-aos="fade-down" data-aos-duration="1500" class="logo">AI PLATFORM</h1>
      </a>
      <nav>
        <a data-aos="fade-down" data-aos-duration="1500" href="howitworks.php">HOW IT WORKS</a>
        <a data-aos="fade-down" data-aos-duration="2000" href="applications.php">APPLICATIONS</a>
        <a data-aos="fade-down" data-aos-duration="2500" href="futureofai.php">FUTURE OF AI</a>
        <a data-aos="fade-down" data-aos-duration="3000" href="aboutus.php"class="active">ABOUT US</a>
		<a data-aos="fade-down" data-aos-duration="3000" href="logout.php" style="color: #ff4444;">LOGOUT</a>
      </nav>
    </header>

    <main>
      <div class="page-content">
        <h2 data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="1500">ABOUT US</h2>
        <p data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="2000">
          Kami adalah tim mahasiswa yang berkomitmen untuk menghadirkan wawasan tentang teknologi AI secara sederhana dan menarik.
          Website ini dikembangkan sebagai proyek edukasi untuk memperkenalkan bagaimana kecerdasan buatan bekerja dan berkembang di masa depan.
        </p>

        <div data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="2500" class="team">
          <div class="member">
            <h3>Ahmad Syukri Rizkillah</h3>
            <p>NIM: 241011402414</p>
          </div>
          <div class="member">
            <h3>Muhammad Mishbahuddin</h3>
            <p>NIM: 241011402497</p>
          </div>
        </div>
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