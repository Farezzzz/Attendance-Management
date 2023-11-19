<?= $this->extend('layoutguru/basefileguru') ?>

<?= $this->section('content') ?>

<body>
  <?php
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
  $guruModel = new App\Models\guruModel();


  $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
  $absen = $absenModel->where($where)->first();

  ?>

  <!-- Preloader -->

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
          <div class="user-profile"><img src="../img/tim/<?= $session->get('guru_nik') ?>.jpg" alt=""></div>
          <!-- User Info -->
          <div class="user-info">
            <h6 class="user-name mb-0"><?= $session->get('guru_name') ?></h6><span><?= $session->get('guru_position') ?></span></h6>
            <h6><?= $session->get('mapel') ?><br><span><?= $session->get('guru_nik') ?></span>
          </div>
        </div>
        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">
          <li><a href="<?= base_url('home') ?>"><i class="bi bi-house-door"></i>Home</a></li>
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

  <div class="container" align="center" style=" position: absolute;top:30%;left:25%; margin: -25px 0 0 -25px;">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Edit Status
          </div>
          <div class="card-body">
            <form action="<?php echo base_url('/user/update') ?>" method="POST">
              <input type="hidden" name="tipe" value="<?php $data_siswa['tipe']; ?>">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="tipe">
                  <option value="1">Hadir</option>
                  <option value="2">Sakit</option>
                  <option value="3">Izin</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">update</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="pt-3"></div>
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
          <li><a href="<?= base_url('guru/home') ?>">
              <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
              </svg><span>Home</span></a></li>

          <li><a href="<?= base_url('guru/listabsen') ?>">
              <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
              </svg><span>List Absen</span></a></li>
          <li><a href="<?= base_url('guru/datasiswa') ?>">
              <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
              </svg><span>Data Siswa</span></a></li>
          <?php if ($session->get('guru_position') == 2) { ?>
            <li><a href="<?= base_url('guru/rekapabsen') ?>">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
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
<?= $this->endSection() ?>