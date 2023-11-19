<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Login - SMKN 2 Cimahi Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="../img/icon_bara.png">
    <link rel="apple-touch-icon" href="../img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="167x167" href="../img/icon_bara.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icon_bara.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/tiny-slider.css">
    <link rel="stylesheet" href="../css/baguetteBox.min.css">
    <link rel="stylesheet" href="../css/rangeslider.css">
    <link rel="stylesheet" href="../css/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="../css/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="../style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="../manifest.json">
  </head>
  <body>
    <!-- Preloader -->
   
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Back Button -->
    <div class="login-back-button"><a href="<?= base_url() ?>">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg></a></div>
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="img/36.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
          <h6 class="mb-3 text-center">Log in SMKN 2 Cimahi Management.</h6>
          <form action="<?=base_url("guru/login/auth")?>" method="post">
            <?php if(session()->getFlashdata('msg')):?>
                <div class="alert custom-alert-2 alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle"></i><?= session()->getFlashdata('msg') ?>
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif;?>
            <div class="form-group">
              <input class="form-control" type="text" name="nik" placeholder="Enter NIK">
            </div>
            <div class="form-group position-relative">
              <input class="form-control" id="psw-input" type="password" name="password" placeholder="Enter Password">
              <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Sign In</button>
          </form>
        </div>
      </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/slideToggle.min.js"></script>
    <script src="../js/internet-status.js"></script>
    <script src="../js/tiny-slider.js"></script>
    <script src="../js/baguetteBox.min.js"></script>
    <script src="../js/countdown.js"></script>
    <script src="../js/rangeslider.min.js"></script>
    <script src="../js/vanilla-dataTables.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/magic-grid.min.js"></script>
    <script src="../js/dark-rtl.js"></script>
    <script src="../js/active.js"></script>
    <!-- PWA -->
    <script src="../js/pwa.js"></script>
    <script>
      function getOS() {
      var userAgent = window.navigator.userAgent,
      //platform = window.navigator?.userAgentData?.platform ?? window.navigator.platform,
      platform = navigator.platform,
      macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
      windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
      iosPlatforms = ['iPhone', 'iPad', 'iPod'],
      os = null;

      if (macosPlatforms.indexOf(platform) !== -1) {
        os = 1; //Mac OS
      } else if (iosPlatforms.indexOf(platform) !== -1) {
        os = 2; //iOS
      } else if (windowsPlatforms.indexOf(platform) !== -1) {
        os = 3; //Windows
      } else if (/Android/.test(userAgent)) {
        os = 4; //Android
      } else if (!os && /Linux/.test(platform)) {
        os = 5; //Linux
      }

      return os;
      }

      // if((getOS() != 2) && (getOS() != 4)){
      //   alert("Aplikasi Hanya bisa di akses pada Android dan iOS!");
      //   window.location.replace("<?=base_url()?>");
      // }
    </script>
  </body>
</html>