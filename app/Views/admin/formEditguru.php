<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            UBAH DATA GURU
        </div>

        <form action="<?= base_url('/admin/guru/aksiEditguru' .'/'.  $guru['guru_id']) ?>" method="post">
            <table width="30%">
                <tr >
                    <td> Nik </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="guru_nik" id="guru_nik" placeholder="Masukkan nik" value="<?= $guru['guru_nik'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_nik'])) echo session()->getFlashdata('error')['guru_nik'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Nama guru </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="guru_nama" id="guru_nama" placeholder="Masukkan Nama" value="<?= $guru['guru_nama'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_nama'])) echo session()->getFlashdata('error')['guru_nama'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Email</td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="guru_email" id="guru_email" placeholder="Masukkan email" value="<?= $guru['guru_email'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_email'])) echo session()->getFlashdata('error')['guru_email'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Position</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="guru_position" id="guru_position" class="form-select input" value="<?= $guru['guru_position']?>">
                        
                                <option value="guru">Guru</option><br>
                                <option value="walikelas">Walikelas</option>

                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_position'])) echo session()->getFlashdata('error')['guru_position'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td> Wakel</td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="guru_wakel" id="guru_wakel" class="form-select input" value="<?= $guru['guru_wakel']?>">

                                <option value="0">Tidak</option><br>
                                <option value="1">Ya</option>

                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_wakel'])) echo session()->getFlashdata('error')['guru_wakel'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="3" align="center"> <br>
                        <a href="<?= base_url('/admin/guru')?>" class="kembali" >< Kembali</a>
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
