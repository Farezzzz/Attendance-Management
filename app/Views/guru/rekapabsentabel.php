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
    <title>Rekap Absen - SMKN 2 Cimahi Management</title>
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
    $uri = new \CodeIgniter\HTTP\URI();
    $session = session();
    $db = db_connect();

    if($session->get('user_admin') != 2){
        ?><script>window.location.replace("<?=base_url('home')?>");</script><?php
    }

    $absenModel = new App\Models\AbsenModel();
    
    $tgl = (isset($_GET['tgl']) && $_GET['tgl']!="")?$_GET['tgl']:date('Y-m-')."01";
    $tglA = (isset($_GET['tglA']) && $_GET['tglA']!="")?$_GET['tglA']:date('Y-m-d');

    $rekap = $db->query("CALL rekapAbsensi('".$tgl."','".$tglA."');")->getResult();
                    
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
          <div class="back-button"><a href="<?=base_url('rekapabsen')?>">
              <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
              </svg></a></div>
          <!-- Page Title -->
          <div class="page-heading">
            <h6 class="mb-0">Rekap Absen Tabel</h6>
          </div>
          <!-- Settings -->
          <div class="setting-wrapper"></div>
        </div>
      </div>
    </div>

    
    

    <div class="page-content-wrapper" style="margin-top:70px">
            <div class="container">
                <form method="get">
                <div class="form-group mb-3">
                    <label class="form-label" for="tgl">Filter Tanggal</label>
                    <input class="form-control" id="tgl" name="tgl" type="text" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" placeholder="Tanggal Awal">
                    <input class="form-control" id="tglA" name="tglA" type="text" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" placeholder="Tanggal Akhir">
                    <button class="btn btn-success w-100" type="submit">Filter</button>
                </div>
                </form>
                


            <div class="element-heading">
            <center><h6>Rekap Absen <?=date('d M Y', strtotime($tgl))?> - <?=date('d M Y', strtotime($tglA))?></h6>
            <?php
                // echo date('D, d M Y H:i')."<br>";
                // $dt = new DateTime('@1655206762');
                // $dt->setTimeZone(new DateTimeZone('Asia/Jakarta'));
                // echo $dt->format('d-m-Y H:i:s');
                // echo password_hash("b4r4d3v3", PASSWORD_DEFAULT);
              ?>
              </center><br>
            </div>
        </div>
        
        <div class="page-content-wrapper py-0">
            <div class="container">
                <div class="card">
                <div class="card-body">
                    <table class="w-100" id="dataTable">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>K</th>
                        <th>S</th>
                        <th>I</th>
                        <th>T</th>
                        <th>TK</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($rekap as $r){
                    ?>
                        <tr>
                        <td><?=$r->user_name?></td>
                        <td><p class="mb-0 fz-12 badge bg-success"><?=$r->hadir?></p></td>
                        <td><p class="mb-0 fz-12 badge bg-primary"><?=$r->wfh?></p></td>
                        <td><p class="mb-0 fz-12 badge bg-warning"><?=$r->dinas?></p></td>
                        <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->telat?></p></td>
                        <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->tk?></p></td>
                        <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->total?></p></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>

       

        

        

    </div>
      

    <div class="pb-3"></div>
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

    //   if((getOS() != 2) && (getOS() != 4)){
    //     alert("Aplikasi Hanya bisa di akses pada Android dan iOS!");
    //     window.location.replace("<?=base_url()?>");
    //   }
    </script>
  </body>
</html>