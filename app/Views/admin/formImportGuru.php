<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            IMPORT FILE
        </div>

        <form method="post" action="<?= base_url('/admin/guru/importExcel') ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>File &ensp;</td>
                    <td> : &ensp;</td>
                    <td><input type="file" name="file_excel" class="form-control input"><br></td>
                </tr>
                <tr>
                    <td colspan="3" align="center" >
                        <a href="<?= base_url('/admin/guru')?>" class="kembali" > Kembali</a>
                        <button type="submit" class="tambah">Import File</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><br>
                    <button type="button" class="btn btn-success">
                        <a href=" <?= base_url ('/download-templateGuru')?>" download style="text-decoration:none;">
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
