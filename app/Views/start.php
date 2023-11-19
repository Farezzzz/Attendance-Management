<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BARA Management">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>SMKN 2 Cimahi Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="img/icon_bara.png">
    <link rel="apple-touch-icon" href="img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icon_bara.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/tiny-slider.css">
    <link rel="stylesheet" href="css/baguetteBox.min.css">
    <link rel="stylesheet" href="css/rangeslider.css">
    <link rel="stylesheet" href="css/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="css/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Hero Block Wrapper -->
    <div class="hero-block-wrapper bg-primary">
      <!-- Styles -->
      <div class="hero-block-styles">
        <div class="hb-styles1" style="background-image: url('img/core-img/dot.png')"></div>
        <div class="hb-styles2"></div>
        <div class="hb-styles3"></div>
      </div>
      <div class="custom-container">
        <!-- Hero Block Content -->
        <div class="hero-block-content"><img class="mb-4" src="img/19.png" alt="">
          <h2 class="display-4 text-white mb-3">SMKN 2 Cimahi</h2>
          <p class="text-white">Presensi Siswa SMKN 2 Cimahi.</p><a class="btn btn-warning btn-lg w-100" href="<?= base_url('login') ?>">Get Started</a>
        </div>
      </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/slideToggle.min.js"></script>
    <script src="js/internet-status.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/rangeslider.min.js"></script>
    <script src="js/vanilla-dataTables.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/magic-grid.min.js"></script>
    <script src="js/dark-rtl.js"></script>
    <script src="js/active.js"></script>
    <!-- PWA -->
    <script src="js/pwa.js"></script>
  </body>
</html>