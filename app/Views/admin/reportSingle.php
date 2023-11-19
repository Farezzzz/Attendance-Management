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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <h2>REKAP PRESENSI</h2>
    <table>
        <thead>
            <tr>

            <th> Nama </th>
            <th> Kelas </th>
            <th> User ID</th>
            <th> Tanggal </th>
            <th> Clock In</th>
            <th> Clock Out</th>
            <th> Tipe</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekap as $report) : ?>
                <tr>
                    <td> <?=$report['siswa_nama']?></td>
                    <td> <?=$report['kelas']?></td>
                    <td> <?=$report['user_id']?> </td>
                    <td> <?=$report['tanggal']?></td>
                    <td> <?=$report['clockin']?></td>
                    <td> <?=$report['clockout']?></td>
                    <td> <?php switch ($report['tipe']){
                            case 0 : 
                                echo 'Tanpa Keterangan'; 
                                break;
                            case 1 : 
                                echo 'Hadir'; 
                                break;
                              case 2 : 
                                echo 'Izin'; 
                                break;
                              case 3 : 
                                echo 'Sakit';
                                break;
                            
                          }?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
