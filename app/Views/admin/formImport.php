<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            IMPORT FILE
        </div>

        <form method="post" action="<?= base_url('/admin/siswa/importExcel') ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>File </td>
                    <td>: &ensp;</td>
                    <td><input type="file" name="file_excel" class="form-control"></td>
                    <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['file_excel'])) echo session()->getFlashdata('error')['file_excel'] ?>
                    </div>
                </tr>
                <tr>
                <td> Kelas </td>
                <td>: &ensp;</td>
                    <td>
                        <select name="kelas_id" id="kelas" class="form-select input">
                            <?php foreach ($kelas as $siswa ):?>
                                <option value="<?= $siswa['kelas_id']?>"><?= $siswa['kelas']?></option><br>
                            <?php endforeach; ?>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>: &ensp;</td>
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="user_password" placeholder="Masukkan password" >
                            
                        </div> 
                        <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_password'])) echo session()->getFlashdata('error')['user_password'] ?>
                            </div>
                    </td>
                </tr>
                <tr >
                    <td colspan="4" align="center"> <br>
                        <a href="<?= base_url('/admin/siswa')?>" class="kembali" > Kembali</a> 
                        <button type="submit" class="tambah">Import File</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><br>
                    <button type="button" class="btn btn-success">
                        <a href=" <?= base_url ('/download-template')?>" download style="text-decoration:none;">
                    Unduh Template Excel</a>
                </button>
                    
                    </td>
                </tr>
            </table>
            
        </form>
    
        <br> <br>
        <footer>
        &copy; Mayang & Fahreza XI-RPLA
        </footer>
</center>

<?= $this->endSection('')?>
