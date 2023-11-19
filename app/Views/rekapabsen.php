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

    if($session->get('user_admin') != 1){
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
          <div class="back-button"><a href="<?=base_url('home')?>">
              <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
              </svg></a></div>
          <!-- Page Title -->
          <div class="page-heading">
            <h6 class="mb-0">Rekap Absen</h6>
          </div>
          <!-- Settings -->
          <div class="setting-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- # Sidenav Left -->
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
      <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <div class="offcanvas-body p-0">
        <!-- Side Nav Wrapper -->
        <div class="sidenav-wrapper">
          <!-- Sidenav Profile -->
          <div class="sidenav-profile bg-gradient">
            <div class="sidenav-style1"></div>
            <!-- User Thumbnail -->
            <div class="user-profile"><img src="img/tim/<?=$session->get('user_nik')?>.jpg" alt=""></div>
            <!-- User Info -->
            <div class="user-info">
              <h6 class="user-name mb-0"><?=$session->get('user_name')?></h6><span><?=$session->get('user_position')?></span><br><span><?=$session->get('user_nik')?></span>
            </div>
          </div>
          <!-- Sidenav Nav -->
          <ul class="sidenav-nav ps-0">
            <li><a href="<?=base_url('home')?>"><i class="bi bi-house-door"></i>Home</a></li>
            <li>
              <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                <div class="form-check form-switch">
                  <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                </div>
              </div>
            </li>
            <li><a href="<?=base_url('logout')?>"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
          </ul>
          <!-- Copyright Info -->
          <div class="copyright-info">
            <p>2022 &copy; Made by<a href="https://smkn2cmi.sch.id">RPL SMKN 2 Cimahi</a></p>
          </div>
        </div>
      </div>
    </div>
    
    

    <div class="page-content-wrapper" style="margin-top:70px">
    <div class="add-new-contact-wrap"><a class="shadow" href="<?=base_url('rekapabsentabel')?>"><i class="bi bi-table"></i></a></div>
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

        <?php
        foreach($rekap as $r){
        ?>
        <div class="container">
            <div class="col-12">
                <div class="card single-product-card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                    <div class="team-member-img shadow-sm">
                        <img src="img/tim/<?=$r->user_nik?>.jpg" alt="" style="object-fit:cover;width:128px;height:128px;">
                    </div>
                    <div class="card-content px-0 py-0" style="width:80%">

                        <div class="card comparison-table-one">
                            <div class="card-body px-3 py-0">
                                <table class="table mb-0">
                                <tbody>
                                    <tr>
                                    <th colspan="2"><h6 class="mb-1 fz-14"><a href="<?=base_url('historyabsen')?>?user=<?=$r->user_id?>"><?=$r->user_name?></a></h6></th>
                                    </tr>
                                    <tr>
                                    <th colspan="2"><p class="mb-0 fz-12 badge bg-primary"><?=$r->user_position?></p></th>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Kehadiran</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-success"><?=$r->hadir?></p></td>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Sakit</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-primary"><?=$r->wfh?></p></td>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Izin</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-warning"><?=$r->dinas?></p></td>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Terlambat</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->telat?></p></td>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Tanpa Keterangan</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->tk?></p></td>
                                    </tr>
                                    <tr>
                                    <th><p class="mb-0 fz-12">Total</p></th>
                                    <td><p class="mb-0 fz-12 badge bg-danger"><?=$r->total?></p></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                        
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="pt-3"></div>
        <?php
        }
        ?>

        

        

    </div>
      

    <div class="pb-3"></div>
    </div>
    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
      <div class="container px-0">
        <!-- =================================== -->
        <!-- Paste your Footer Content from here -->
        <!-- =================================== -->
        <!-- Footer Content -->
        <div class="footer-nav position-relative">
          <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
            <li><a href="<?=base_url('home')?>">
                <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
                </svg><span>Home</span></a></li>
            <li><a href="<?=base_url('historyabsen')?>">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>History Absen</span></a></li>
            <?php if($session->get('user_admin') == 1){ ?>
            <li><a href="<?=base_url('listabsen')?>">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>List Absen</span></a></li>
            <li class="active"><a href="<?=base_url('rekapabsen')?>">
                <svg class="bi bi-folder2-open" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"></path>
                </svg><span>Rekap Absen</span></a></li>
            <?php } ?>
            <li><a href="" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <svg class="bi bi-gear" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
                  <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
                </svg><span>Settings</span></a></li>
          </ul>
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