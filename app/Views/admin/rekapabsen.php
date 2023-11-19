<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  
<?php 
    $session = session();
    $db = db_connect();
?>

<div class="Container-DSiswa">

    <div class="Sidebar">
            <?= $this->include('Layout/navbar')?>
    </div>

    <div class="Content">

        <div class="Navbar">
            <?= $this->include('Layout/logout')?>
        </div>

        <div class="Container-Top">
            <div class="Top">
                    <h1>REKAP PRESENSI</h1>
            </div>  
        </div>

        <div class="Container-Siswa">
          <div class="Content-Siswa">
              <h4>Data Rekap Presensi</h4>
              
                <?php if (session('message2')) {?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Alert! </strong> <?=session('message2')?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php } ?>
                
              <div class="Action">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col"> 
                                    <input type="text"  placeholder="Cari Nama" name="nama" class="cari">
                                </div>

                                <div class="col">
                                <?php
                                        if ($session->get('user_position') != 'walikelas') {
                                            ?>  
                                            <select name="kelas" id="siswa" class="cari" >
                                                <option value="">Semua Kelas</option>
                                                <?php foreach ($dataKelas as $kelas ):?>
                                                    <option value="<?= $kelas['kelas']?>"><?= $kelas['kelas']?></option><br>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php } ?>
                                
                                </div>
                                <div class="col"><input type="date"  placeholder="Cari Tanggal" name="tanggal" class="cari"></div>
                                <div class="col"><button type="submit" name="submit"><i class="fa fa-regular fa-magnifying-glass"></i></button></div> 
                                    
                            </div>
                        </form>   
                        <!-- Button trigger modal -->
                        <button type="button" data-bs-toggle="modal" data-bs-target="#report">
                        <i class="fa-solid fa-print"></i> &ensp; Cetak PDF
                        </button>
                    </div>
                        <!-- Modal -->
                        <div class="modal fade" id="report" tabindex="-1" aria-labelledby="reportLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="reportLabel">Report Presensi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('report/pdf') ?>" method="post">
                                <div class="row">
                                    
                                    <div class="col">
                                        <label for="">Cari Nama</label>
                                        <input type="text"  placeholder="Cari Nama" name="nama" class="form-control">
                                    </div>
                                    <!-- <div class="col">
                                        <label for="">Cari NIS</label>
                                        <input type="number"  placeholder="Cari NIS" name="nis" class="form-control">
                                    </div> -->
                                    <div class="col">
                                        <?php
                                            if ($session->get('user_position') != 'walikelas') {
                                                ?>  
                                                <label for="">Pilih Kelas</label>
                                                <select name="kelas" id="siswa" class="form-select" >
                                                <option value="">Semua Kelas</option>
                                                <?php foreach ($dataKelas as $kelas ):?>
                                                    <option value="<?= $kelas['kelas']?>"><?= $kelas['kelas']?></option><br>
                                                    <?php endforeach; ?>
                                                </select><br>
                                         <?php } ?>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- <div class="col">
                                        <label for="">Tangggal Awal</label>
                                        <input type="date"  placeholder="Cari Tanggal" name="tanggal" class="form-control" ><br>
                                    </div>
                                    <div class="col">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date"  placeholder="Cari Tanggal" name="tanggal2" class="form-control" ><br>
                                    </div> -->
                                    <div class="col">
                                        <input type="hidden" name="nis">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="">Bulan</label>
                                        <input type="month" class="form-control" name="bulan" required> <br>

                                    </div>
                                    <div class="col">
                                        <label for=""></label>
                                        <button type="submit" name="submit" class="btn btn-primary ms-auto rp">Report</button>
                                    </div>
                                </div>    
                            </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div> 
                  <table class="Tabel-Siswa" border="1">
                    <tr>
                        <th class="Nomor"> No </th>
                        <th> Nama </th>
                        <th> Kelas </th>
                        <th> Tanggal </th>
                        <th> Clock In</th>
                        <th> Clock Out</th>
                        <th> Tipe</th>
                        <th> Action</th>
                    </tr>
                
                    <?php foreach ($data_rekap as $index => $rekap): ?>
                    <tr>
                        <td><?= $nomor++ ?>  </td>
                        <td> <?= $rekap['siswa_nama']?></td>
                        <td> <?= $rekap['kelas']?></td>
                        <td> <?= $rekap['tanggal']?></td>
                        <td> <?= $rekap['clockin']?></td>
                        <td> <?= $rekap['clockout']?></td>
                        <td> <?php switch ($rekap['tipe']){
                              case 0 : 
                                echo 'Tanpa Keterangan'; 
                                break;
                              case 1 : 
                                echo 'Hadir'; 
                                break;
                              case 3 : 
                                echo 'Izin'; 
                                break;
                              case 2 : 
                                echo 'Sakit';
                                break;
                            
                          }?></td>
                        <td>
                            <div class="Option">
                            <a href="<?= base_url('/admin/rekapabsen/edit') .'/'. $rekap['absen_id']?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                
                            </div>
                        </td>
                    </tr>

                      <?php endforeach;?> 
                  </table>

                  <div class="page">
                    <?= $pager->Links('rekapabsen', 'pagination') ?>
                  </div>   

                  <p class="Copyright">
                  &copy; Mayang & Fahreza XI-RPLA
                  </p>
            </div>

        </div>

    </div>
    
</div>
  
<?= $this->endSection('')?>