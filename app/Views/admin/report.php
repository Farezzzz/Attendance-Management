<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
    <style>
        /* Gaya CSS untuk laporan */
        body {
            font-family: Arial, sans-serif;
        }
        h2{
            text-align: center;
        }
        p{
            text-align: center;
            font-size: 13px;
        }
        .bulan{
            font-size: 18px;

        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            font-size: 8.5px;
        }
    </style>
</head>
<body>
    <h2>REKAP PRESENSI</h2>

        <p class="bulan"><?= $bulanText?> <?= $tahun?><br>
        <p> SEKOLAH MENENGAH KEJURUAN NEGERI 2 CIMAHI <br> <br>

     ---------------------------------------------------------------------------------------------------------- </p>
    <br>
    
    <table>
        <thead>
            <tr>
                <th>NIS</th>
            <th> Nama </th>
            <th> Kelas </th>
            <?php
                switch ($bulan) {
                    case 'january'|| 'march'|| 'may'|| 'july'|| 'september'|| 'november' :
                    $jumlahHari = 31;
                    break;
                    case 'april'|| 'june'|| 'august'|| 'october'|| 'december' :
                        $jumlahHari = 30;
                        break;
                    case 'february' :
                        if ($tahun%4 >0) {
                            $jumlahHari = 29;
                        } else {
                            $jumlahHari = 30;
                        }                   
                }
               for ($i=1;$i <= $jumlahHari; $i++) {
                 ?>
                 <th><?= $i ?></th>
             <?php  } ?>
            
            <th>H</th>
            <th>S</th>
            <th>I</th>
            <th>A</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekap as $report) : ?>
                <tr>
                    <td> <?=$report['siswa_nis']?></td>
                    <td> <?=$report['siswa_nama']?></td>
                    <td> <?=$report['kelas']?></td>
                    <?php
                        for ($i=1;$i <= $jumlahHari; $i++) { ?> 
                            <td>
                            <?php
                            foreach($subRekap as $sub){
                                if ($sub['user_id'] == $report['user_id'] && $i == date("d",strtotime($sub['tanggal']))) { 
                                        switch ($sub['tipe']) {
                                            case 1 :
                                            echo 'H';
                                            break;
                                            case 2 :
                                            echo 'S';
                                            break;
                                            
                                            case 3 :
                                            echo 'I';
                                            break;
                                            case 0 :
                                            echo 'A';
                                            break;
                                        default : 
                                        echo $sub['tipe'];
                                        break;
                                        }
                                    }
                            } ?>
                           </td>
                        <?php } ?>
                    <td> <?=$report['hadir']?></td>
                    <td> <?=$report['sakit']?></td>
                    <td> <?=$report['izin']?></td>
                    <td> <?=$report['tanpa_keterangan']?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>

</body>
</html>