<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\AbsenModel;
use App\Models\GuruModel;
use App\Models\UserModel;
use App\Models\KelasModel;

class ReportController extends BaseController
{
    public function generatePDF()
    {
        $session = session(); 
        $AbsenModel = new AbsenModel;
        $AbsenModel2 = new AbsenModel;
        $KelasModel = new KelasModel();  
        $GuruModel = new GuruModel();

        $nama = $this->request->getVar('nama') != null ? $this->request->getVar('nama') : '';
        $kelas = $this->request->getVar('kelas') != null ? $this->request->getVar('kelas') : '';
        $bulan = $this->request->getVar('bulan') != null ? $this->request->getVar('bulan') : '';
        
        $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
        ->join('walikelas','walikelas.guru_id=guru.guru_id')
        ->where('users.user_id', $session->get('user_id'))->first();

        
        if ($session->get('user_position') == 'walikelas') {
            $Rekap = $AbsenModel->search2( $nama, $kelas, $bulan)
            ->where('kelas.kelas_id', $wakel['kelas_id'])
            ->orderBy('siswa_nama')->groupBy('user_id');
        $subRekap = $AbsenModel2->search3( $nama, $kelas, $bulan)
            ->where('kelas.kelas_id', $wakel['kelas_id'])
            ->orderBy('siswa_nama');
        }   
        else {
            $Rekap = $AbsenModel->search2( $nama, $kelas, $bulan)
            ->orderBy('siswa_nama')->groupBy('user_id');
            $subRekap = $AbsenModel2->search3( $nama, $kelas, $bulan)
                       ->orderBy('siswa_nama');
        }      
        
        $data['rekap'] = $Rekap->findAll();
        $data['subRekap'] = $subRekap->findAll();
        $data['bulan'] = preg_replace("/[^\w.]/", "", $bulan);
        $data['tahun'] = preg_replace("/[^\d.]/", "", $bulan);

        $bulanText = date('F', strtotime($bulan));
        $data['bulanText'] = $bulanText;

        $tahun = date('Y', strtotime($bulan));
        $data['tahun'] = $tahun;

        $dompdf = new Dompdf();

        // Tampilan laporan PDF 
        $view = view('/admin/report', $data, ['saveData' => true]);
        
        // Memuat HTML ke Dompdf
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($view);
        $dompdf->render();
        $dompdf->stream('laporan.pdf', ['Attachment' => false]);

    }
}