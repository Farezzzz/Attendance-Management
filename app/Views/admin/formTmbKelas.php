<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            TAMBAH KELAS
        </div>

        <form action="<?= base_url('/admin/kelas/aksiCreateKelas') ?>" method="post">
            <table width="30%">
                <tr >
                    <td> Kelas</td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="kelas" id="Kelas" placeholder="Masukkan Nama Kelas" >
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['kelas'])) echo session()->getFlashdata('error')['kelas'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr>
                 
                    <td colspan="3" align="center"><br>
                    <a href="<?= base_url('/admin/kelas')?>" class="kembali" >< Kembali</a>
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
