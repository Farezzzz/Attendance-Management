<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  



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
                    <h1>SISWA</h1>
                    <a href="<?= base_url('/admin/siswa/createSiswa')?>"> Tambah </a>
            </div>  
        </div>

        <div class="Container-Siswa">
          <div class="Content-Siswa">
              <h4>Data Siswa</h4>

                <?php if (session('message')) {?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alert! </strong> <?=session('message')?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php } ?>

                <?php if (session('message2')) {?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Alert! </strong> <?=session('message2')?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php } ?>

                  
                  <div class="Action">
                        <form action="" method="get">
                            <input type="text"  placeholder="Cari Nama Siswa..." name="keyword" class="cari">
                            <button type="submit" name="submit"><i class="fa fa-regular fa-magnifying-glass"></i></button>
                        </form>    
                            <a href="<?= base_url('/admin/siswa/import')?>"><i class="fa fa-regular fa-file-import"></i> <p>Import Excel</p></a>
                        
                  </div>

                  <table class="Tabel-Siswa" border="1" style="width: ">
                      <tr>
                          <th class="Nomor"> No </th>
                          <th> NIS</th>
                          <th> Nama Siswa</th>
                          <th> Kelas</th>
                          <th> Email</th>
                          <th> Position</th>
                          <th> Action</th>
                      </tr>
                    
                      <?php foreach ($data_siswa as $index => $siswa): ?>
                        
                        <tr>
                          <td><?= $nomor++ ?>  </td>
                          <td> <?= $siswa['siswa_nis']?> </td>
                          <td> <?= $siswa['siswa_nama']?></td>
                          <td> <?= $siswa['kelas']?></td>
                          <td> <?= $siswa['siswa_email']?></td>
                          <td> <?= $siswa['siswa_position']?></td>
                        
                          <td>
                                <div class="Option">
                                    <a href="<?= base_url('/admin/siswa/edit') .'/'. $siswa['siswa_id']?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="<?= base_url('/admin/siswa/delete') .'/'. $siswa['siswa_id']?>"
                                        onclick="return confirm('Are u serious right now brouuuu??? ')" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                                </div>        
                          </td>
                              
                        </tr> 
                      <?php endforeach;?> 
                  </table>

                  <div class="page">
                    <?= $pager->Links('siswa', 'pagination') ?>
                  </div>   

                  <p class="Copyright">
                  &copy; Mayang & Fahreza XI-RPLA
                  </p>
            </div>

        </div>

    </div>
    
</div>
  
<?= $this->endSection('') ?>
    
   