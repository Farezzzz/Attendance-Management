<?= $this->extend('layoutsiswa/basefilesiswa') ?>

<?= $this->section('content') ?>

<body>
  <?php
  $session = session();
  $absenModel = new App\Models\AbsenModel();
  $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
  $absen = $absenModel->where($where)->first();
  if (isset($absen['clockout'])) {
    header("Location:" . base_url('siswa/home'));
  }
  if (!isset($absen['clockin'])) {
    header("Location:" . base_url('siswa/home'));
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
        <div class="back-button"><a href="<?= base_url('siswa/home') ?>">
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
          <form action="<?= base_url('siswa/clockout/save') ?>" method="post" enctype="multipart/form-data">
            <?php if (session()->getFlashdata('msgci')) : ?>
              <div class="alert alert-danger"><?= session()->getFlashdata('msgci') ?></div>
            <?php endif; ?>
            <div class="form-group mb-3">
              <label class="form-label" for="fullname">Nama</label>
              <input class="form-control" id="fullname" type="text" value="<?= $session->get('user_name') ?>" placeholder="Full Name" readonly>
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
              <input class="form-control" id="lat" name="lat" type="text" value="" placeholder="Lat">
            </div>
            <div class="form-group mb-3">
              <label class="form-label" for="long">Long</label>
              <input class="form-control" id="long" name="long" type="text" value="" placeholder="Long">
            </div>
            <button class="btn btn-success w-100" type="submit">Clock Out</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection() ?>