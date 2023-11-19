<?= $this->extend('Layout/basefile.php') ?>

<?= $this->section('content') ?>  


<center>
    <div class="container">

        <div class="header">
            UBAH DATA REKAP
        </div>


        <form action="<?= base_url('/admin/rekapabsen/aksiEditRekap/' .  $data_rekap['absen_id']) ?>" method="post">
            <table width="30%">
                <tr>
                    <td> User ID</td>
                    <td> : &ensp;</td>
                    <td>
                        <div class="form-group input">
                            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="ID" value="<?= $data_rekap['user_id'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['user_id'])) echo session()->getFlashdata('error')['user_id'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>
                <tr >
                    <td> Tanggal </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?= $data_rekap['tanggal'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['tanggal'])) echo session()->getFlashdata('error')['tanggal'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>

                <tr >
                    <td> Clock In </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="datetime-local" class="form-control" name="clockin" id="clockin" placeholder="Clock Out" value="<?= $data_rekap['clockin'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['clockin'])) echo session()->getFlashdata('error')['clockin'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>

                <tr >
                    <td> Clock Out </td>
                    <td> : &ensp;</td> 
                    <td>
                        <div class="form-group input">
                            <input type="datetime-local" class="form-control" name="clockout" id="clockout" placeholder="Clock Out" value="<?= $data_rekap['clockout'] ?>">
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['clockout'])) echo session()->getFlashdata('error')['clockout'] ?>
                            </div>
                        </div> 
                    </td>
                </tr>

                <tr >
                    <td> Tipe </td>
                    <td> : &ensp;</td> 
                    <td>
                        <select class="input" name="tipe" id="tipe" value="<?= $data_rekap['tipe'] ?>">
                            <option value="0"> Tanpa Keterangan </option>
                            <option value="1"> Hadir </option>
                            <option value="3"> Izin </option>
                            <option value="2"> Sakit </option>
                            <div class="text-danger">
                                <?php if(isset(session()->getFlashdata('error')['tipe'])) echo session()->getFlashdata('error')['tipe'] ?>
                            </div>
                        </select>
                    </td>
                </tr>


                <tr>
                   <td colspan="3" align="center"><br>
                        <a href="<?= base_url('/admin/rekapabsen')?>" class="kembali" >< Kembali</a>
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
