<?= $this->extend('layoutguru/basefileguru') ?>

<?= $this->section('content') ?>
<body>
  <?php
  $tgl = (isset($_GET['tgl']) && $_GET['tgl'] != "") ? $_GET['tgl'] : date('Y-m-d');
  $session = session();
  $db = db_connect();

  if ($session->get('user_skema') == 2) {
    if (date('d') < 20) $ba = date('m') - 1;
    else $ba = date('m');

    if ((date('m') == 1) && (date('d') < 20)) $ta = date('Y') - 1;
    else $ta = date('Y');

    $tgl_awal = $ta . '-' . $ba . '-20';
  } else if ($session->get('user_skema') == 3) {
    if (date('d') < 8) $ba = date('m') - 1;
    else $ba = date('m');

    if ((date('m') == 1) && (date('d') < 8)) $ta = date('Y') - 1;
    else $ta = date('Y');

    $tgl_awal = $ta . '-' . $ba . '-08';
  } else {
    $tgl_awal = date('Y-m-') . '01';
  }
  $absenModel = new App\Models\AbsenModel();
  $UserModel = new App\Models\UserModel();
  $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
  $absen = $absenModel->where($where)->first();
  ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>
  <!-- Internet Connection Status -->
  <!-- # This code for showing internet connection status -->
  <div class="internet-connection-status" id="internetStatus"></div>
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
          <div class="user-profile"><img src="<?= base_url('/img/tim') ?>/<?= $session->get('user_nik') ?>.jpg" alt=""></div>
          <!-- User Info -->
          <div class="user-info">
            <h6 class="user-name mb-0"><?= $session->get('user_name') ?></h6><span><?php if ($session->get('user_admin') == 1) {
                                                                                      echo "walikelas";
                                                                                    } elseif ($session->get('user_admin') == 2) {
                                                                                      echo "Guru Mapel";
                                                                                    } ?></span></h6>
            <h6><?= $session->get('mapel') ?><br><span><?= $session->get('guru_nik') ?></span>
          </div>
        </div>
        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">
          <li><a href="<?= base_url('guru/home') ?>"><i class="bi bi-house-door"></i>Home</a></li>
          <li>
            <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
              <div class="form-check form-switch">
                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
              </div>
            </div>
          </li>
          <li><a href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
        <!-- Copyright Info -->
        <div class="copyright-info">
          <p>2022 &copy; Made by<a href="https://smkn2cmi.sch.id">RPL SMKN 2 Cimahi</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="page-content-wrapper" style="margin-top:-20px">
    <!-- Tiny Slider One Wrapper -->
    <div class="tiny-slider-one-wrapper">
      <div class="tiny-slider-one">
        <!-- Single Hero Slide -->
        <div>
          <div class="single-hero-slide">
            <div class="h-100 d-flex align-items-center text-center">
              <div class="container">
                <?php
                $session = session();
                $user_nik = $session->get('user_nik');
                $qr = "qrcodes/{$user_nik}.png"; // path gambar
                ?>
                <div class="container direction-rtl" style="width: 180px;padding:0px 10px"><img class="img-fluid" src="<?= base_url($qr); ?>" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content-wrapper" style="margin-top:-20px">
      <div class="container">
        <div class="element-heading">
          <center>
            <h6>Halo, <?= $session->get('user_name') ?></h6>
            <?php
            echo date('D, d M Y H:i') . "<br>";
            // $dt = new DateTime('@1655206762');
            // $dt->setTimeZone(new DateTimeZone('Asia/Jakarta'));
            // echo $dt->format('d-m-Y H:i:s');
            // echo password_hash("b4r4d3v3", PASSWORD_DEFAULT);
            ?>
          </center><br>
        </div>
      </div>
      <?php $current_date = date("Y-m-d") ?>
      <div class="pt-3"></div>

      <div class="container">
        <div class="card">
          <div class="card-body direction-rtl">
            <div class="row">
              <div class="col-4">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center">
                  <?php
                  $hadir = $db->query("SELECT count(absen_id) as jml FROM absensi WHERE tanggal>='" . $tgl . "' AND tipe=1")->getRow()->jml;

                  ?>

                  <h4 class="mb-0"><span class="counter"><?= $hadir ?></span></h4>
                  <p class="mb-0">hari</p><span class="solid-line" style="background-color:#109b00;"></span>
                  <p class="mb-0">KEHADIRAN</p>

                </div>
              </div>
              <div class="col-4">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center">
                  <?php
                  $hadir = $db->query("SELECT count(absen_id) as jml FROM absensi WHERE tanggal>='" . $tgl . "' AND tipe=2")->getRow()->jml;
                  ?>
                  <h4 class="mb-0"><span class="counter"><?= $hadir ?></span></h4>
                  <p class="mb-0">hari</p><span class="solid-line"></span>
                  <p class="mb-0">SAKIT</p>
                </div>
              </div>
              <div class="col-4">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center">
                  <?php
                  $hadir = $db->query("SELECT count(absen_id) as jml FROM absensi WHERE tanggal>='" . $tgl . "' AND tipe=3")->getRow()->jml;
                  ?>
                  <h4 class="mb-0"><span class="counter"><?= $hadir ?></span></h4>
                  <p class="mb-0">hari</p><span class="solid-line" style="background-color:#ffa726"></span>
                  <p class="mb-0">IZIN</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-3"></div>
    </div>
    <div class="pt-3"></div>
  </div>
  <div class="pb-3"></div>
  </div>
</body>
<?= $this->endSection() ?>