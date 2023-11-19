<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<?php
    $session = session();
    $db = db_connect();
   
    $absenModel = new App\Models\AbsenModel();
    $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
    $absen = $absenModel->where($where)->first();
?>


<div class="Container-Home" id="dekstop">

        <div class="NavbarAdm">

            <img src="/img/logo.png" alt=""> 
            <p> Admin <br> Page </p>
        

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link nav" href="<?= base_url('/admin/home')?>">Home</a>
                  </li>
                <li class="nav-item ">
                  <a class="nav-link nav" href="<?= base_url('/admin/user')?>">Data User</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link nav" href="<?= base_url('/admin/rekapabsen')?>">Rekap Presensi</a>
                </li>
                <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle nav" href="#" role="button" data-bs-toggle="dropdown">Menu Lainnya</a>
                  <ul class="dropdown-menu">
                  <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?>  <li><a class="dropdown-item" href="<?= base_url('/admin/kelas')?>">Kelas</a></li></li>
                        <?php } ?>
                        <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?>  <li><a class="dropdown-item" href="<?= base_url('/admin/walikelas')?>">Walikelas</a></li></li>
                        <?php } ?>
                        <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?>  <li><a class="dropdown-item" href="<?= base_url('/admin/guru')?>">Guru</a></li></li>
                        <?php } ?>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/siswa')?>">Data Siswa</a></li>
                  </ul>
                </li>
            </ul>

             <a href="<?= base_url('login')?>" class="logout"> Logout </a>
          
        </div>

        <div class="Welcome">

            <h1> 
                Welcome, <br> 
                <?=$session->get('user_name')?>.
            </h1>

            <p>
                Here you can do many things like view data, <br>
                change data, add data and delete data.
            </p>

            <a href="<?= base_url('/admin/user')?>"> View Data > </a>

        </div>

        <div class="Ellipse">

            <img src="/img/welcome.jpg" alt="">

        </div>
</div>
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

      
        if((getOS() == 2) || (getOS() == 4)){
          window.location.replace("siswa/home");
        }
      

      
    </script>

<?= $this->endSection('') ?>