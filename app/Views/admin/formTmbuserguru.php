<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            TAMBAH USER GURU
        </div>
        
        <form action="<?= base_url('/admin/user/aksiCreateuserguru') ?>" method="post">
            <table width="40%">
            <tr >
                    <td> Nama-(NIK)</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="user_nik" id="guru" class="form-select input" >
                            <?php foreach ($guru as $user ):?>
                                <option value="<?= $user['guru_nik']?>"><?= $user['guru_nama']?>-(<?= $user['guru_nik']?>)</option><br>
                            <?php endforeach; ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_nik'])) echo session()->getFlashdata('error')['user_nik'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td> Username </td>
                    <td> : &ensp;</td> 
                    <td>
                    <div class="form-group input">
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Masukkan Username" >
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_name'])) echo session()->getFlashdata('error')['user_name'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Email</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="user_email" id="guru" class="form-select input">
                            <?php foreach ($guru as $user ):?>
                                <option value="<?= $user['guru_email']?>"><?= $user['guru_email']?></option><br>
                            <?php endforeach; ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_email'])) echo session()->getFlashdata('error')['user_email'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td> Position</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select class="input" name="user_position" id="user_position">
                            <option value="guru">Guru</option>
                            <option value="walikelas">Walikelas</option>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_position'])) echo session()->getFlashdata('error')['user_position'] ?>
                            </div>
                       </select>
                    </td>
                </tr>
                <tr >
                    <td> Password </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="user_password" id="user_password" placeholder="Masukkan password" >
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_password'])) echo session()->getFlashdata('error')['user_password'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> User skema</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select class="input" name="user_skema" id="position">
                            <option value="2">Guru</option>
                            <option value="4">Walikelas</option>
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
                        <select class="input" name="user_status" id="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_status'])) echo session()->getFlashdata('error')['user_status'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><br>
                        <a href="<?= base_url('/admin/user')?>" class="kembali" >< Kembali</a>
                        <button type="submit" class="tambah"> Tambah + </button>
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
