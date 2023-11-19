<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            UBAH DATA WALIKELAS
        </div>

        <form action="<?= base_url('/admin/walikelas/aksiEditwalikelas' .'/'.  $walikelas['walikelas_id']) ?>" method="post">
            <table width="30%">
                
                <tr >
                    <td> Nama Guru </td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="guru_id" id="guru" class="form-select input">
                            <option value="<?= $gurunow['guru_id']?>" selceted><?= $gurunow['guru_nama']?></option>
                            <?php foreach ($guru as $walikelas ):?>
                                <option value="<?= $walikelas['guru_id']?>"><?= $walikelas['guru_nama']?></option><br>
                            <?php endforeach; ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['guru_id'])) echo session()->getFlashdata('error')['guru_id'] ?>
                            </div>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td> Kelas </td>
                    <td> : &ensp;</td> 
                    <td>
                        <select name="kelas_id" id="kelas" class="form-select input" >
                        <option value="<?= $kelasnow['kelas_id']?>" selceted><?= $kelasnow['kelas']?></option>
                            <?php foreach ($kelas as $walikelas):?>
                                <option value="<?= $walikelas['kelas_id']?>"><?= $walikelas['kelas']?></option><br>
                            <?php endforeach; ?>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['kelas_id'])) echo session()->getFlashdata('error')['kelas_id'] ?>
                            </div>
                        </select>
                    </td>
                </tr>          
                <tr>
                    <td colspan="3" align="center"> <br>
                        <a href="<?= base_url('/admin/walikelas')?>" class="kembali" >< Kembali</a>
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
