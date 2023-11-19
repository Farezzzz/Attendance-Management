<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            KATEGORI
        </div>

        <form action="<?= base_url('/admin/user/aksiValidasi') ?>" method="post">
            <table width="30%">
                <tr >
                    <td> Pilih Kategori</td>
                    <td> : &ensp;</td> 
                    <td>
                            <select name="nama" id="" class="form-select input">
        
                                <?php $session = session();
                                  if (session()->get('user_admin') == 1) {?>
                                    <option value="Guru">Guru</option>
                                <?php } ?>
                                
                                <option value="Siswa">Siswa</option>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><br>
                        <a href="<?= base_url('/admin/user')?>" class="kembali" > Kembali</a>
                        <button type="submit" class="tambah"> Lanjut </button>
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
