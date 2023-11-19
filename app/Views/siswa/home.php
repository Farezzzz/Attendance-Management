<?= $this->extend('layoutsiswa/basefilesiswa') ?>

<?= $this->section('content') ?>
<body>
    <?php
    $session = session();
    $db = db_connect();
  
    if($session->get('user_skema')==2){
        if(date('d') < 20) $ba = date('m')-1;
        else $ba = date('m');

        if((date('m') == 1) && (date('d') < 20)) $ta = date('Y')-1;
        else $ta = date('Y');

        $tgl_awal = $ta . '-' . $ba . '-20';
    } else if($session->get('user_skema')==3){
        if(date('d') < 8) $ba = date('m')-1;
        else $ba = date('m');

        if((date('m') == 1) && (date('d') < 8)) $ta = date('Y')-1;
        else $ta = date('Y');

        $tgl_awal = $ta . '-' . $ba . '-08';
    } else {
        $tgl_awal = date('Y-m-').'01';
    }

    $absenModel = new App\Models\AbsenModel();
    $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
    $absen = $absenModel->where($where)->first();
    ?>
    <!-- Preloader -->
    <!-- <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div> -->
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
            <?php
            $session = session();
            $user_nik = $session->get('user_nik');
            $profil = "img/tim/{$user_nik}.jpg"; // path gambar
            ?>
            <div class="user-profile"><img src="<?=base_url($profil)?>" alt=""></div>
            <!-- User Info -->
            <div class="user-info">
              <h6 class="user-name mb-0"><?=$session->get('user_name')?></h6><span><?=$session->get('user_position')?></span><br><span><?=$session->get('user_nik')?></span>
            </div>
          </div>
          <!-- Sidenav Nav -->
          <ul class="sidenav-nav ps-0">
            <li><a href="<?=base_url('siswa/home')?>"><i class="bi bi-house-door"></i>Home</a></li>
            <li><a href="<?=base_url('siswa/gantipassword')?>"><i class="bi bi-shield-lock"></i>Ganti Password</a></li>
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
            <p>2023 &copy; Iqbal & Rafly XI RPL A</p>
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
                  <div class="container direction-rtl" style="padding:0px 150px"><img class="img-fluid" src="<?=base_url('img/logo.png')?>" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <div class="page-content-wrapper" style="margin-top:-20px">
        <div class="container">
            <div class="element-heading">
            <?php if(session()->getFlashdata('msg')):?>
                <div class="alert custom-alert-2  alert-success alert-dismissible fade show" role="alert" ><i class="bi bi-check-circle-fill"></i><?= session()->getFlashdata('msg') ?>
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif;?>
            <center><h6>Halo, <?=$session->get('user_name')?></h6>
            <?php
                echo date('D, d M Y H:i')."<br>";
                // $dt = new DateTime('@1655206762');
                // $dt->setTimeZone(new DateTimeZone('Asia/Jakarta'));
                // echo $dt->format('d-m-Y H:i:s');
                // echo password_hash("b4r4d3v3", PASSWORD_DEFAULT);
              ?>
              </center><br>
            </div>
        </div>

        <div class="team-member-wrapper direction-rtl">
            <div class="container">
            <div class="row g-3">                       
                <!-- Single Team Member-->
                <div class="col-6">
                <div class="card team-member-card">
                    <div class="card-body">
                    <!-- Member Image-->
                    <?php if(isset($absen['foto'])){ ?>
                      <?php 
                      $foto_in = "img/clockin/{$absen['foto']}"; // path gambar
                      ?>
                    <div class="team-member-img shadow-sm"><img src="<?=base_url($foto_in)?>" alt="" style="object-fit:cover;width:128px;height:128px;"></div>
                    <?php } else { ?>
                    <div class="team-member-img" style=""><img src="<?=base_url('img/check-in.png')?>" alt=""></div>
                    <?php } ?>
                    <!-- Team Info-->
                    <div class="team-info">
                        <h6 class="mb-1 fz-14">07:15:00</h6>
                        <p class="mb-0 fz-12">MASUK SEKOLAH</p>
                        <?php
                        if(isset($absen['clockin']) && (strtotime(date('H:i:s', strtotime($absen['clockin']))) > strtotime('07:15:00'))) $bg = "bg-danger";
                        else $bg = "bg-primary";
                        ?>
                        <h6 class="mb-3 fz-14 badge <?=$bg?>"><?=(isset($absen['clockin']))?date('H:i:s', strtotime($absen['clockin'])):'00:00:00'?></h6>
                        <?php if(isset($absen['tipe'])){ ?>
                        <h6 class="mb-3 fz-14 badge bg-success">
                        <?php
                          if($absen['tipe']==1){
                              echo "Hadir di Sekolah";
                          } else if($absen['tipe']==2){
                              echo "Izin";
                          } else if($absen['tipe']==3){
                              echo "Sakit";
                          }
                        ?>
                        </h6>
                        <?php } ?><br>
                        <a class="btn btn-info btn-round <?=(isset($absen['clockin']))?'disabled':''?>" href="<?=base_url('qrscanner')?>">Clock In</a>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Single Team Member-->
                <div class="col-6">
                <div class="card team-member-card">
                    <div class="card-body">
                    <!-- Member Image-->
                    <?php if(isset($absen['foto_out'])){ ?>
                      <?php 
                      $foto_out = "img/clockout/{$absen['foto_out']}"; // path gambar
                      ?>
                    <div class="team-member-img shadow-sm"><img src="<?= base_url($foto_out)?>" alt="" style="object-fit:cover;width:128px;height:128px;"></div>
                    <?php } else { ?>
                    <div class="team-member-img" style="border-radius:0"><img src="<?=base_url('img/check-out.png')?>" alt=""></div>
                    <?php } ?>
                    <!-- Team Info-->
                    <div class="team-info">
                        <h6 class="mb-1 fz-14">14:00:00</h6>
                        <p class="mb-0 fz-12">PULANG SEKOLAH</p>
                        <h6 class="mb-3 fz-14 badge bg-primary"><?=(isset($absen['clockout']))?date('H:i:s', strtotime($absen['clockout'])):'00:00:00'?></h6>
                        <?php if(isset($absen['tipe'])){ ?>
                        <h6 class="mb-3 fz-14 badge bg-success">
                        <?php
                          if($absen['tipe']==1){
                            echo "Hadir di Sekolah";
                          } else if($absen['tipe']==2){
                              echo "Izin";
                          } else if($absen['tipe']==3){
                              echo "Sakit";
                          } else if($absen['tipe']==3)
                        ?>
                        </h6>
                        <?php } ?><br>
                        <a class="btn btn-info btn-round <?=(isset($absen['clockin']) && !isset($absen['clockout']))?'':'disabled'?>" href="<?=base_url('siswa/clockout')?>">Clock Out</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="pt-3"></div>

        <div class="container">
            <div class="card">
            <div class="card-body direction-rtl">
                <div class="row">
                <div class="col-4">
                    <!-- Single Counter -->
                    <div class="single-counter-wrap text-center">
                    <?php
                    $hadir = $db->query("SELECT count(tipe) as jml FROM absensi WHERE tanggal>='".$tgl_awal."' AND user_id='".$session->get('user_id')."' AND tipe=1")->getRow()->jml;
                    ?>
                    <h4 class="mb-0"><span class="counter"><?=$hadir?></span></h4><p class="mb-0">hari</p><span class="solid-line" style="background-color:#109b00;"></span>
                    <p class="mb-0">KEHADIRAN</p>
                    </div>
                </div>
                <div class="col-4">
                    <!-- Single Counter -->
                    <div class="single-counter-wrap text-center">
                    <?php
                    $wfh = $db->query("SELECT count(tipe) as jml FROM absensi WHERE tanggal>='".$tgl_awal."' AND user_id='".$session->get('user_id')."' AND tipe=2")->getRow()->jml;
                    ?>
                    <h4 class="mb-0"><span class="counter"><?=$wfh?></span></h4><p class="mb-0">hari</p><span class="solid-line"></span>
                    <p class="mb-0">IZIN</p>
                    </div>
                </div>
                <div class="col-4">
                    <!-- Single Counter -->
                    <div class="single-counter-wrap text-center">
                    <?php
                    $dinas = $db->query("SELECT count(tipe) as jml FROM absensi WHERE tanggal>='".$tgl_awal."' AND user_id='".$session->get('user_id')."' AND tipe=3")->getRow()->jml;
                    ?>
                    <h4 class="mb-0"><span class="counter"><?=$dinas?></span></h4><p class="mb-0">hari</p><span class="solid-line" style="background-color:#ffa726"></span>
                    <p class="mb-0">SAKIT</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="pt-3"></div>

        <?php
        $dataAbsensi = $db->query("SELECT sum(tk) tk, sum(telat) telat,sum(total) total FROM dataabsensi WHERE tanggal>='".$tgl_awal."' AND user_id='".$session->get('user_id')."'")->getRow();
        ?>
        <div class="container">
            <div class="card">
            <div class="card-body direction-rtl">
                <div class="row">
                <!-- <div class="col-4">
                    <!-- Single Counter -->
                    <!-- <div class="single-counter-wrap text-center">
                    <h4 class="mb-0"><span class="counter"><?=$dataAbsensi->telat?></span></h4><p class="mb-0">kali</p><span class="solid-line" style="background-color:red"></span>
                    <p class="mb-0">TERLAMBAT</p>
                    </div>
                </div>
                <div class="col-4"> -->
                    <!-- Single Counter -->
                    <!-- <div class="single-counter-wrap text-center">
                    <h4 class="mb-0"><span class="counter"><?=$dataAbsensi->tk?></span></h4><p class="mb-0">kali</p><span class="solid-line" style="background-color:red"></span>
                    <p class="mb-0">TANPA KETERANGAN</p>
                    </div> -->
                <!-- </div> --> 
                <div class="col-12">
                    <!-- Single Counter -->
                    <div class="single-counter-wrap text-center">
                      <?php 
                      $totalMenit = $dataAbsensi->total;
                      $jam = floor($totalMenit / 60);
                      $menit = $totalMenit % 60;
                      $totalJam = sprintf("%02d:%02d", $jam, $menit);
                      ?>
                    <h4 class="mb-0"><span class="counter"><?=$totalJam?></span></h4><p class="mb-0"><?php if($totalJam <= "00:60" ){echo"detik";}else{echo"menit";} ?></p><span class="solid-line" style="background-color:red"></span>
                    <p class="mb-0">TOTAL</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="pt-3"></div>

        <!-- <div class="container">
            <!-- <div class="card bg-primary">
            <div class="card-body direction-rtl">
                <!-- <div class="row">
                <!-- <div class="col-4">
                    <!-- Single Counter -->
                    <!-- <div class="single-counter-wrap text-center">
                    <h4 class="mb-0 text-white"><span class="counter">0</span></h4><p class="mb-0 text-white">task</p><span class="solid-line" style="background-color:#ffa726;"></span>
                    <p class="mb-0 text-white">To Do</p>
                    </div>
                </div>
                <div class="col-4">
                    Single Counter
                    <div class="single-counter-wrap text-center">
                    <h4 class="mb-0 text-white"><span class="counter">0</span></h4><p class="mb-0 text-white">task</p><span class="solid-line" style="background-color:#00faff"></span>
                    <p class="mb-0 text-white">In Progress</p>
                    </div>
                </div>
                <!-- <div class="col-4">
                    <!-- Single Counter -->
                    <!-- <div class="single-counter-wrap text-center">
                    <h4 class="mb-0 text-white"><span class="counter">0</span></h4><p class="mb-0 text-white">task</p><span class="solid-line" style="background-color:#109b00"></span>
                    <p class="mb-0 text-white">Done</p>
                    </div> 
                </div> 
                </div>
            </div>
            </div>
        </div> 
    </div>  -->
<?= $this->endSection() ?>