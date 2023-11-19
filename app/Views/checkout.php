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
    <title>Clock Out - SMKN 2 Cimahi Management</title>
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
    <?php
    $session = session();
    $absenModel = new App\Models\AbsenModel();
    $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
    $absen = $absenModel->where($where)->first();
    if(isset($absen['clockout'])){
      header("Location:".base_url('home'));
    }
    if(!isset($absen['clockin'])){
      header("Location:".base_url('home'));
    }
    ?>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
      <div class="container">
        <!-- Header Content -->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
          <!-- Back Button -->
          <div class="back-button"><a href="<?=base_url('home')?>">
              <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
              </svg></a></div>
          <!-- Page Title -->
          <div class="page-heading">
            <h6 class="mb-0">Clock Out</h6>
          </div>
          <!-- Settings -->
          <div class="setting-wrapper"></div>
        </div>
      </div>
    </div>
    
    <div class="page-content-wrapper py-3">

      <div class="container">
        <!-- User Information-->
        
        <!-- User Meta Data-->
        <div class="card user-data-card">
          <div class="card-body">
            <form action="<?=base_url('clockout/save')?>" method="post" enctype="multipart/form-data">
              <?php if(session()->getFlashdata('msgci')):?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgci') ?></div>
              <?php endif;?>
              <div class="form-group mb-3">
                <label class="form-label" for="fullname">Nama</label>
                <input class="form-control" id="fullname" type="text" value="<?=$session->get('user_name')?>" placeholder="Full Name" readonly>
              </div>
              <div class="form-group mb-3">
              <label class="form-label" for="foto">Foto Selfie</label>
                <!-- <input class="form-control" id="foto" name="foto2" type="file" placeholder="foto" accept="image/*" capture> -->
                <div class="form-file">
                <input class="form-control d-none" id="foto" type="file" name="foto" accept="image/*" capture>
                  <label class="form-file-label justify-content-center w-100" for="foto"><span class="form-file-button btn btn-danger d-flex align-items-center justify-content-center shadow-lg">
                      <svg class="bi bi-plus-circle me-2" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                      </svg>Capture Foto Selfie</span></label>
                </div>
                <input class="form-control" id="nf" name="nf" type="text" value="" placeholder="Tidak Ada Foto" readonly>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="lat">Lat</label>
                <input class="form-control" id="lat" name="lat" type="text" value="" placeholder="Lat" readonly>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="long">Long</label>
                <input class="form-control" id="long" name="long" type="text" value="" placeholder="Long" readonly>
              </div>
              <button class="btn btn-success w-100" type="submit">Clock Out</button>
            </form>
          </div>
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

    <script>
        window.onload = function() {
            getLocation();
        };

        var x = document.getElementById("lat");
        var y = document.getElementById("long");
        var m = document.getElementById("map");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.value = "Geolocation is not supported by this browser.";
                y.value = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.value = position.coords.latitude;
            y.value = position.coords.longitude;
        }
    </script>
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

      if((getOS() != 2) && (getOS() != 4)){
        alert("Aplikasi Hanya bisa di akses pada Android dan iOS!");
        window.location.replace("<?=base_url()?>");
      }

      document.getElementById("foto").onchange = function() {funcSetName()};

      function funcSetName() {
        var x = document.getElementById("nf");
        x.value = document.getElementById("foto").files[0].name;
      }
    </script>
</body>
</html>