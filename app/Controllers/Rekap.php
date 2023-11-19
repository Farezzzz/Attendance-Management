<?php

    namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\AbsenModel;
use App\Models\GuruModel;


    class Rekap extends BaseController{
        public function index(){  
            $session = session(); 
            $AbsenModel = new AbsenModel();  
            $KelasModel = new KelasModel();  
            $GuruModel = new GuruModel();

            $tanggal= $this->request->getVar('tanggal') != null ? $this->request->getVar('tanggal') : '';
            $nama = $this->request->getVar('nama') != null ? $this->request->getVar('nama') : '';
            $kelas = $this->request->getVar('kelas') != null ? $this->request->getVar('kelas') : '';
            
            $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
            ->join('walikelas','walikelas.guru_id=guru.guru_id')
            ->where('users.user_id', $session->get('user_id'))->first();

            
            if ($session->get('user_position') == 'walikelas') {
                $Rekap = $AbsenModel->search($tanggal, $nama, $kelas)->where('kelas.kelas_id', $wakel['kelas_id'])->orderBy('tanggal');
            }
            else {
                $Rekap = $AbsenModel->search($tanggal, $nama, $kelas)->orderBy('tanggal');
            }      
            
            $data_rekap = $Rekap->paginate(10, 'rekapabsen');
            $dataKelas= $KelasModel->findAll();
            $pager = $AbsenModel->pager;
            
            $nomor = order_page_number($this->request->getVar('page_rekapabsen'), 10);
            
            return view('/admin/rekapabsen', compact('data_rekap', 'pager', 'nomor', 'dataKelas'));

        }
        public function editrekap($id)
        {

            $AbsenModel = new AbsenModel(); 
            $data_rekap = $AbsenModel->where('absen_id', $id)->first();
            return view('/admin/formEditRekap', compact('data_rekap'));
        }
        public function aksiEditRekap($id)
        {
            $isValidated = $this->validate([
                'user_id' => 'required',
                'tanggal' => 'required',
                'clockin' => 'required',
                'clockout' => 'required',
                'tipe' => 'required'
            ]);

            if ($isValidated) {
                $AbsenModel = new AbsenModel();
                $absenData = $AbsenModel->find($id); // Mengambil data dengan absen_id yang cocok

                if ($absenData) {
                    $absenData['user_id'] = $this->request->getPost('user_id');
                    $absenData['tanggal'] = $this->request->getPost('tanggal');
                    $absenData['clockin'] = $this->request->getPost('clockin');
                    $absenData['clockout'] = $this->request->getPost('clockout');
                    $absenData['tipe'] = $this->request->getPost('tipe');

                    $AbsenModel->update($absenData['absen_id'], $absenData); // Menyimpan perubahan

                    session()->setFlashdata('message2', 'Data Have Been Updated');
                    return redirect()->to('/admin/rekapabsen/');
                } else {
                    // Data tidak ditemukan, lakukan penanganan kesalahan
                    session()->setFlashdata('error', 'Data not found');
                    return redirect()->to(base_url('/admin/rekapabsen/edit/' . $id));
                }
            } else {
                $error = $this->validator->getErrors();
                session()->setFlashdata('error', $error);

                return redirect()->to(base_url('/admin/rekapabsen/edit/' . $id));
            }
        }
    }
?>