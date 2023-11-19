<?= $this->extend('layoutsiswa/basefilesiswa') ?>

<?= $this->section('content') ?>
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
        <h6 class="mb-0">Ganti Password</h6>
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
    <div class="card-body">
      <form action="<?= base_url('siswa/gantipassword/save') ?>" method="post" enctype="multipart/form-data">
        <?php if (session()->getFlashdata('msg')) : ?>
          <div class="alert custom-alert-2 alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle"></i><?= session()->getFlashdata('msg') ?>
            <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <div class="form-group mb-3">
          <label class="form-label" for="current_password">Password Saat Ini</label>
          <div class="input-group">
            <input class="form-control" id="current_password" name="current_password" type="password" placeholder="Masukkan Password Saat Ini">
            <button class="btn btn-secondary" type="button" id="toggle_current_password">
              <i class="bi bi-eye-slash" id="current_password_icon"></i>
            </button>
          </div>
          <div class="text-danger">
            <?php if (isset(session()->getFlashdata('error')['current_password'])) echo session()->getFlashdata('error')['current_password'] ?>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="form-label" for="new_password">Password Baru</label>
          <div class="input-group">
            <input class="form-control" id="new_password" name="new_password" type="password" placeholder="Masukkan Password Baru">
            <button class="btn btn-secondary" type="button" id="toggle_new_password">
              <i class="bi bi-eye-slash" id="new_password_icon"></i>
            </button>
          </div>
          <div class="text-danger">
            <?php if (isset(session()->getFlashdata('error')['new_password'])) echo session()->getFlashdata('error')['new_password'] ?>
          </div>
        </div>
        <button class="btn btn-success w-100" type="submit">Simpan</button>
      </form>
    </div>
  </div>
</div>
</div>
<script>
  // get flash message
  let msg = "<?php echo session()->getFlashdata('alert'); ?>";
  if (msg) {
    alert(msg);
  }
</script>

<script>
  const togglePassword = (inputId, iconId) => {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove("bi-eye-slash");
      icon.classList.add("bi-eye");
    } else {
      input.type = "password";
      icon.classList.remove("bi-eye");
      icon.classList.add("bi-eye-slash");
    }
  };

  document.getElementById("toggle_current_password").addEventListener("click", () => {
    togglePassword("current_password", "current_password_icon");
  });

  document.getElementById("toggle_new_password").addEventListener("click", () => {
    togglePassword("new_password", "new_password_icon");
  });
</script>

<?= $this->endSection() ?>