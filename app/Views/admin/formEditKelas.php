<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            UBAH DATA KELAS
        </div>

        <form action="<?= base_url('/admin/kelas/aksiEditkelas' .'/'.  $data_kelas['kelas_id']) ?>" method="post" >
            <table>
                <tr>
                    <td> Kelas</td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="kelas" id="Kelas" placeholder="Masukkan Nama Kelas" value="<?= $data_kelas['kelas'] ?>" >
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['kelas'])) echo session()->getFlashdata('error')['kelas'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                 
                    <td colspan="3" align="center"><br>
                        <a href="<?= base_url('/admin/kelas')?>" class="kembali" >< Kembali</a>
                        <button type="submit" class="tambah"> Selesai </button>
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
