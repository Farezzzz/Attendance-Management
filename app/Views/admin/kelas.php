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
                <h1>KELAS</h1>
                <a href="<?= base_url('/admin/kelas/createKelas')?>"> Tambah </a>
            </div>  
        </div>

        <div class="Container-Siswa">

            <div class="Content-Siswa">
                  <h4>Data Kelas</h4>


                <?php if (session('message2')) {?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Alert! </strong> <?=session('message2')?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php } ?>

                  <div class="Action">
                      
                      <form action="" method="get">
                          <input type="text"  placeholder="Cari Kelas..." name="keyword" class="cari">
                          <button type="submit" name="submit"><i class="fa fa-regular fa-magnifying-glass"></i></button>
                      </form>    
                  </div>
              

              <table class="Tabel-Siswa" border="1">
                  <tr>
                      <th> No </th>
                      <th> Kelas</th>
                      <th> Action</th>
                  </tr>
                      <?php foreach ($data_kelas as $index => $kelas): ?>
                  <tr>
                      <td><?= $nomor++ ?></td>
                      <td><?= $kelas['kelas']?></td>
                      <td class="Option">
                            <a href="<?= base_url('/admin/kelas/edit') .'/'. $kelas['kelas_id']?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="<?= base_url('/admin/kelas/delete') .'/'. $kelas['kelas_id']?>"
                                onclick="return confirm('Are u serious right now brouuuu??? ')" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="<?= base_url('/admin/kelas/data') .'/'. $kelas['kelas_id']?>" class="detail"><i class="fa-solid fa-circle-info"></i></a> 

                      </td> 
                  </tr> 
                      <?php endforeach;?> 
        
              </table>

              <div class="page">
                  <?= $pager->Links('kelas', 'pagination') ?>
              </div>

              <footer class="Copyright">
              &copy; Mayang & Fahreza XI-RPLA
              </footer>

            </div>

        </div>

    </div>

</div>


<?= $this->endSection('') ?> 