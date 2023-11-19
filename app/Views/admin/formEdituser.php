<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  
<?php 
    $session = session();
    $db = db_connect();
?>

<center>
    <div class="container">

        <div class="header">
            UBAH DATA USER
        </div>

        <form action="<?= base_url('/admin/user/aksiEdituser' .'/'.  $user['user_id']) ?>" method="post">
            <table width="30%">
                <tr >
                    <td> Username </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Masukkan username" value="<?= $user['user_name'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_name'])) echo session()->getFlashdata('error')['user_name'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                    <td> Position</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select class="input" name="user_position" id="user_position" value="<?= $user['user_position'] ?>">
                            <option value="siswa">Siswa</option>
                            <option value="km">Ketua Murid</option>
                            <?php if ($session->get('user_position') != 'walikelas') {?>
                                <option value="guru">Guru</option>
                                <option value="walikelas">Walikelas</option>
                            <?php } ?>
                            
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_nik'])) echo session()->getFlashdata('error')['user_nik'] ?>
                            </div>

                       </select>
                    </td>
                </tr>
                <tr >
                    <td> Password </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="user_password" id="user_password" placeholder="Masukkan password" value="<?= $user['user_password'] ?> ">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_password'])) echo session()->getFlashdata('error')['user_password'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <?php if ($session->get('user_position') != 'walikelas') {?>
                <tr >
                    <td> User admin</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select class="input" name="user_admin" id="user_admin" value="<?= $user['user_admin'] ?>">
                            <option value="0">Tidak</option>
                            <option value="1">Iya</option>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_admin'])) echo session()->getFlashdata('error')['user_admin'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <?php } ?>
                <tr >
                    <td> User skema</td>
                    <td> : &ensp;</td> 
                    <td>
                    <select class="input" name="user_skema" id="skema" value="<?= $user['user_skema'] ?>">         
                            <option value="3">Siswa</option>
                            <option value="5">Ketua Murid</option>
                            <?php if ($session->get('user_position') != 'walikelas') {?>
                                <option value="2">Guru</option>
                                <option value="4">Walikelas</option>
                            <?php } ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_skema'])) echo session()->getFlashdata('error')['user_skema'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td> User status</td>
                    <td> : &ensp;</td> 
                    <td>
                            <select class="input" name="user_status" id="user_status" value="<?= $user['user_status'] ?>">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_status'])) echo session()->getFlashdata('error')['user_status'] ?>
                            </div>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center"> <br>
                        <a href="<?= base_url('/admin/user')?>" class="kembali" > Kembali</a>
                        <button type="submit" class="tambah">Simpan</button>
                    </td>
                </tr>
              
            </table>
            <br><br><br>
            
        </form>
    
        <br> <br>
        <footer>
        &copy; Mayang & Fahreza XI-RPLA
        </footer>
</center>

<?= $this->endSection('')?>
