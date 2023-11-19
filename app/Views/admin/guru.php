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
                  <h1>GURU</h1>
                  <a href="<?= base_url('/admin/guru/Create')?>"> Tambah </a>
              </div>  
        </div>

        <div class="Container-Siswa">
            <div class="Content-Siswa">
                <h4>Data Guru</h4>

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
                        <input type="text"  placeholder="Cari Nama Guru..." name="keyword" class="cari">
                        <button type="submit" name="submit"><i class="fa fa-regular fa-magnifying-glass"></i></button>
                    </form>    
                    <a href="<?= base_url('/admin/guru/import')?>"><i class="fa fa-regular fa-file-import"></i><p>Import Excel</p> </a>
                          
                </div>

                <table class="Tabel-Siswa" border="1">
                    <tr> 
                        <th> No </th>
                        <th> NIK</th>
                        <th> Nama Guru</th>
                        <th> Email</th>
                        <th> Position</th>
                        <th> Wakel</th>
                        <th> Action</th>
                    </tr>
                        <?php foreach ($data_guru as $index => $guru): ?>
                    <tr>
                        <td><?= $nomor++ ?>  </td>
                        <td> <?= $guru['guru_nik']?> </td>
                        <td> <?= $guru['guru_nama']?></td>
                        <td> <?= $guru['guru_email']?></td>
                        <td> <?= $guru['guru_position']?></td>
                        <td> <?php switch ($guru['guru_wakel']){
                            case 1 : 
                                echo 'Sudah'; 
                                break;
                            case 0 : 
                                echo 'Belum'; 
                                break;                         
                          }?></td>
                        <td class="Option">
                            <a href="<?= base_url('/admin/guru/edit') .'/'. $guru['guru_id']?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="<?= base_url('/admin/guru/delete') .'/'. $guru['guru_id']?>"
                            onclick="return confirm('Are u serious right now brouuuu??? ')" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                        </td> 
                    </tr> 
                        <?php endforeach;?> 
                </table>

                <div class="page">
                    <?= $pager->Links('guru', 'pagination') ?>
                </div>   

                <p class="Copyright">
                &copy; Mayang & Fahreza XI-RPLA
                </p>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection('') ?>