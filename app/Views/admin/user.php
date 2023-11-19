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
                <h1>USER</h1>
                <a href="<?= base_url('/admin/user/validasi')?>"> Tambah </a>
              </div>  
        </div>


        <div class="Container-Siswa">
            <div class="Content-Siswa">
                <h4>Data User</h4>

                <?php if (session('message2')) {?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Alert! </strong> <?=session('message2')?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                    <div class="Action">
                        <form action="" method="get">
                            <input type="text"  placeholder="Cari Nama User..." name="keyword" class="cari">
                            <button type="submit" name="submit" ><i class="fa fa-regular fa-magnifying-glass"></i></button>
                        </form>    
                    </div>
            
                <table class="Tabel-User" border="1">

                    <tr>
                        <th class="Nomor"> No </th>
                        <th> Nomor Induk</th>
                        <th> Username</th>
                        <th> Email</th>
                        <th> Position</th>
                        <th> Password</th>
                        <th> User Admin</th>
                        <th> User Skema</th>
                        <th> User Status</th>
                        <th> User Created at</th>
                        <th> Action</th>
                    </tr>
                 
                        <?php foreach ($data_user as $index => $user): ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td> <?= $user['user_nik']?> </td>
                        <td> <?= $user['user_name']?></td>
                        <td> <?= $user['user_email']?></td>
                        <td> <?= $user['user_position']?></td>
                        <td> Default</td>
                        <td> <?php switch ($user['user_admin']){
                            case 1 : 
                                echo 'Ya'; 
                                break;
                            case 0 : 
                                echo 'Tidak'; 
                                break;                       
                            }?></td>
                        <td> <?php switch ($user['user_skema']){
                            case 1 : 
                                echo 'Admin'; 
                                break;
                            case 2 : 
                                echo 'Guru'; 
                                break;
                            case 3 : 
                                echo 'Siswa';
                                break;
                            case 4:
                                echo 'Walikelas';
                                break; 
                            case 5:
                                echo 'KM';
                                break; 
                            }?></td>
                        <td> <?php switch ($user['user_status']){
                            case 1 : 
                                echo 'Aktif'; 
                                break;
                            case 0 : 
                                echo 'Tidak Aktif'; 
                                break;         
                          }?></td>
                        <td> <?= $user['user_created_at']?></td>
                        <td >
                            <div class="Option">
                            
                              <a href="<?= base_url('/admin/user/edit') .'/'. $user['user_id']?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                              <a href="<?= base_url('/admin/user/delete') .'/'. $user['user_id']?>"
                                onclick="return confirm('Are u serious right now brouuuu??? ')" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                            
                        </td> 
                    </tr> 
                      <?php endforeach;?> 
                        
                </table>

              <div class="page">
                  <?= $pager->Links('users', 'pagination') ?>
              </div>

              <p class="Copyright">
                  &copy; Mayang & Fahreza XI-RPLA
              <p>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection('') ?>