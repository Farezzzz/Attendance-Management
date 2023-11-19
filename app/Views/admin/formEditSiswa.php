<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  
<?php 
    $session = session();
    $db = db_connect();
?>

<center>
    <div class="container">

        <div class="header">
            UBAH DATA SISWA
        </div>

        <form action="<?= base_url('/admin/siswa/aksiEditsiswa' .'/'.  $siswa['siswa_id']) ?>" method="post">
            <table width="30%">
                <tr >
                    <td> NIS </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="number" class="form-control" name="siswa_nis" id="siswa_nis" placeholder="Masukkan NIS" value="<?= $siswa['siswa_nis'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['siswa_nis'])) echo session()->getFlashdata('error')['siswa_nis'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Nama Siswa </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="siswa_nama" id="siswa_nama" placeholder="Masukkan Nama" value="<?= $siswa['siswa_nama'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['siswa_nama'])) echo session()->getFlashdata('error')['siswa_nama'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Email</td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="siswa_email" id="siswa_email" placeholder="Masukkan email" value="<?= $siswa['siswa_email'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['siswa_email'])) echo session()->getFlashdata('error')['siswa_email'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Position</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="siswa_position" id="siswa_position" class="form-select input" value="<?= $siswa['siswa_position']?>">
                                <option value="siswa">Siswa</option>
                                <option value="km">KM</option><br>
                                

                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['siswa_position'])) echo session()->getFlashdata('error')['siswa_position'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <?php if ($session->get('user_position') == 'walikelas') {?>
                <tr>
                        
                            <td> Kelas </td>
                            <td> : &ensp;</td> 
                            <td>
                             <select name="kelas_id" id="kelas" class="form-select input">
                             <?php foreach ($kelas as $siswa ):?>
                                     <option value="<?= $siswa['kelas_id']?>" <?= $idWakel == $siswa['kelas_id'] ? 'selected':''?> disabled><?= $siswa['kelas']?></option><br>
                                 <?php endforeach; ?>
                             </select>
                            <input type="hidden" name="kelas_id" value="<?= $idWakel?>">

                        
                        
                    </td>
                </tr>
                <?php } if ($session->get('user_position') != 'walikelas'){ ?>
                    <tr >
                    <td> Kelas </td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="kelas_id" id="kelas" class="form-select input">
                            <?php foreach ($kelas as $siswa ):?>
                                <option value="<?= $siswa['kelas_id']?>"><?= $siswa['kelas']?></option><br>
                            <?php endforeach; ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['kelas_id'])) echo session()->getFlashdata('error')['kelas_id'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="center"> <br>
                        <a href="<?= base_url('/admin/siswa')?>" class="kembali" >Kembali</a>
                        <button type="submit" class="tambah"> Simpan </button>
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
