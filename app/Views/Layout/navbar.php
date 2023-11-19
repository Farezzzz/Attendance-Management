<?php

use App\Controllers\Walikelas;

    $session = session();
    $db = db_connect();
  

    $absenModel = new App\Models\AbsenModel();
    $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
    $absen = $absenModel->where($where)->first();
?>

      <h2> 
      <!-- User Thumbnail -->
        <img src="<?=base_url('img/tim') ?>/<?=$session->get('user_nik')?>.jpg" alt="" class="ProfileAdm" style="border-radius: 50%;"><br><br>
          <!-- <div class="user-profile"><img src="img/tim/<?=$session->get('user_nik')?>.jpg" alt=""></div> -->
      <!-- User Info -->
          <div class="user-info">
              <p class="user-name mb-0"><?=$session->get('user_name')?></p>
              <span><?=$session->get('user_nik')?></span><br>
              <span><?=$session->get('user_position')?></span>          
            </div>
      </h2> 

        <div class="Menu-List">
                <p>Main Menu</p>
                <ul>
                    <li><a href="<?= base_url('/admin/home')?>"><i class="fa fa-regular fa-fire"></i>Dashboard</a></li>
                    <li><a  href="<?= base_url('/admin/user')?>"><i class="fa-solid fa-user"></i>Data User</a></li>
                    <li><a  href="<?= base_url('/admin/siswa')?>"><i class="fa fa-solid fa-graduation-cap"></i>Data Siswa</a></li>
                    <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?> <li><a  href="<?= base_url('/admin/guru')?>"><i class="fa fa-solid fa-chalkboard-user"></i>Data Guru</a></li>
                        <?php } ?>
                    <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?> <li><a  href="<?= base_url('/admin/kelas')?>"><i class="fa-solid fa-school"></i>Data Kelas</a></li>
                    <?php } ?> 
                    <?php
                        if ($session->get('user_position') != 'walikelas') {
                            ?> <li><a  href="<?= base_url('/admin/walikelas')?>"><i class="fa-solid fa-user-secret"></i>Data Walikelas</a></li>
                    <?php } ?> 
                    <li><a  href="<?= base_url('/admin/rekapabsen')?>"><i class="fa-regular fa-calendar-days"></i> Rekap Presensi</a></li>


                </ul>


        </div>
   
   



