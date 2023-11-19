<?= $this->extend('layoutguru/basefileguru') ?>

<?= $this->section('content') ?>

<body>
  <?php
  $uri = new \CodeIgniter\HTTP\URI();
  $session = session();
  $db = db_connect();
  // $absenModel = new App\Models\AbsenModel();
  $tgl = (isset($_GET['tgl']) && $_GET['tgl'] != "") ? $_GET['tgl'] : date('Y-m-d');
  $skema = (isset($_GET['skema']) && $_GET['skema'] != "") ? 'user_skema IN (' . $_GET['skema'] . ') AND ' : '';
  // $where = array('tanggal' => $tgl);
  // $absen = $absenModel->where($where)->findAll();

  if (isset($_GET['tipe']) && $_GET['tipe'] != "") {
    if ($_GET['tipe'] == 6)
      $tipe = 'tipe is NULL AND ';
    else
      $tipe = 'tipe=' . $_GET['tipe'] . ' AND ';
  } else {
    $tipe = '';
  }
  $absen = $db->query("SELECT * FROM users u LEFT JOIN absensi a ON a.user_id=u.user_id AND a.tanggal='" . $tgl . "' WHERE $skema $tipe user_skema!=0")->getResultArray();

  ?>
  <!-- Preloader -->

  <!-- Internet Connection Status -->
  <!-- # This code for showing internet connection status -->
  <div class="internet-connection-status" id="internetStatus"></div>
  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button"><a href="<?= base_url('guru/home') ?>">
            <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
            </svg></a></div>
        <!-- Page Title -->
        <div class="page-heading">
          <h6 class="mb-0">List Absen</h6>
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
          <div class="user-profile"><img src="<?= base_url('/img/tim') ?>/<?= $session->get('user_nik') ?>.jpg" alt=""></div>
          <!-- User Info -->
          <div class="user-info">
            <h6 class="user-name mb-0"><?= $session->get('user_name') ?></h6><span><?php if ($session->get('user_skema') == 2) {
                                                                                      echo "walikelas";
                                                                                    } elseif ($session->get('user_skema') == 1) {
                                                                                      echo "Guru Mapel";
                                                                                    } ?></span></h6>
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
  <div class="page-content-wrapper" style="margin-top:70px">
    <div class="container">
      <form method="get">
        <div class="form-group mb-3">
          <label class="form-label" for="tgl">Filter</label>
          <input class="form-control" id="tgl" name="tgl" placeholder="Pilih Tanggal" type="text" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
          
          <select class="form-select" id="tipe" name="tipe">
            <option value="">All</option>
            <option value="1">Hadir di Sekolah</option>
            <option value="2">izin</option>
            <option value="3">sakit</option>
          </select>
          <button class="btn btn-success w-100" type="submit">Filter</button>
        </div>
      </form>
      <div class="element-heading">
        <center>
          <h6>List Absen <?= date('d M Y', strtotime($tgl)) ?></h6>
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
    foreach ($absen as $d) {
    ?>
      <?php if (($d['user_skema'] == 3)) { ?>
        <div class="container">
          <h6 class="mb-1 fz-14"><?= $d['user_name'] ?>
            <?php
            if ($d['tipe'] == 1) {
              echo " (Hadir di Sekolah)";
            } else if ($d['tipe'] == 2) {
              echo " (sakit)";
            } else if ($d['tipe'] == 3) {
              echo " (izin)";
            } else {
              echo " (Tanpa Keterangan)";
            }
            ?>
          </h6>
        </div>
        <div class="team-member-wrapper direction-rtl">
          <div class="container">
            <div class="row g-3">
              <!-- Single Team Member-->
              <div class="col-6">
                <div class="card team-member-card">
                  <div class="card-body">
                    <!-- Member Image-->
                    <?php if (isset($d['foto'])) { ?>
                      <?php
                      $foto_in = "img/clockin/{$d['foto']}"; // path gambar
                      ?>
                      <div class="team-member-img shadow-sm"><img src="<?= base_url($foto_in) ?>" alt="" style="object-fit:cover;width:128px;height:128px;"></div>
                    <?php } else { ?>
                      <div class="team-member-img" style="border-radius:0"><img src="<?=base_url('img/check-in.png') ?>" alt=""></div>
                    <?php } ?>
                    <!-- Team Info-->
                    <div class="team-info">
                      <p class="mb-0 fz-12">MASUK SEKOLAH</p>
                    
                      <?php
                      if (!empty($d['clockin'])) {
                        $clockinTime = strtotime(date('H:i:s', strtotime($d['clockin'])));
                        if ($clockinTime > strtotime('08:20:00')) {
                            $bg = "bg-danger";
                        } else {
                            $bg = "bg-primary"; // Atur nilai latar belakang lainnya jika tidak memenuhi kondisi
                        }
                    } else {
                        $bg = "bg-primary"; // Atur nilai latar belakang lainnya jika $d['clockin'] bernilai null atau kosong
                    }
                    
                      ?>
                      <h6 class="mb-3 fz-14 badge <?= $bg ?>"><?= (isset($d['clockin'])) ? date('H:i:s', strtotime($d['clockin'])) : '00:00:00' ?></h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Team Member-->
              <div class="col-6">
                <div class="card team-member-card">
                  <div class="card-body">
                    <!-- Member Image-->
                    <?php if (isset($d['foto_out'])) { ?>
                      <?php
                      $foto_out = "img/clockout/{$d['foto_out']}"; // path gambar
                      ?>
                      <div class="team-member-img shadow-sm"><img src="<?= base_url($foto_out) ?>" alt="" style="object-fit:cover;width:128px;height:128px;"></div>
                    <?php } else { ?>
                      <div class="team-member-img" style="border-radius:0"><img src="<?=base_url('img/check-out.png') ?>" alt=""></div>
                    <?php } ?>
                    <!-- Team Info-->
                    <div class="team-info">
                      <p class="mb-0 fz-12">PULANG SEKOLAH</p>
                      <h6 class="mb-3 fz-14 badge bg-primary"><?= (isset($d['clockout'])) ? date('H:i:s', strtotime($d['clockout'])) : '00:00:00' ?></h6>
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
    <?php
    }
    ?>
  </div>
  <div class="pb-3"></div>
  </div>
</body>
<?= $this->endSection() ?>