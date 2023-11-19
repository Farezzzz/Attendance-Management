<?php

namespace App\Controllers;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\UserModel;
use App\Models\WalikelasModel;
use App\Models\GuruModel;

use PhpOffice\PhpSpreadsheet\IOFactory;


class Siswa extends BaseController{
    public function siswa()
    {
        $session = session(); 
        $SiswaModel = new SiswaModel;
        $WalikelasModel = new WalikelasModel;
        $GuruModel = new GuruModel;
        $UserModel = new UserModel;
        $keyword = $this->request->getVar('keyword');

        $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
            ->join('walikelas','walikelas.guru_id=guru.guru_id')
            ->where('users.user_id', $session->get('user_id'))->first();
        
        if ($keyword) {
            if ($session->get('user_position') == 'walikelas') {
                $siswa = $SiswaModel->join('kelas','kelas.kelas_id=siswa.kelas_id')
                ->where('siswa.kelas_id', $wakel['kelas_id'])->search($keyword);
            }
            else {
                $siswa = $SiswaModel->join('kelas','kelas.kelas_id=siswa.kelas_id')->search($keyword);
            }
        } 
        else {
            if ($session->get('user_position') == 'walikelas') {
                $siswa = $SiswaModel->join('kelas','kelas.kelas_id=siswa.kelas_id')
                        ->where('siswa.kelas_id', $wakel['kelas_id'])->search($keyword);
            }
            else {
                $siswa = $SiswaModel->join('kelas','kelas.kelas_id=siswa.kelas_id')->search($keyword);
            }
        }
        
        $data_siswa = $siswa->orderBy('siswa_nama')->paginate(10, 'siswa');
        $pager = $SiswaModel->join('kelas','kelas.kelas_id=siswa.kelas_id')->pager;
       
        $nomor = order_page_number($this->request->getVar('page_siswa'), 10);
        
        return view('/admin/siswa', compact('data_siswa', 'pager', 'nomor'));
    }
    public function buatsiswa()
    {
        $session = session(); 
        $GuruModel = new GuruModel;
        $KelasModel = new KelasModel();
        $WalikelasModel = new WalikelasModel();
        $data['kelas'] = $KelasModel->findAll();
        $data['judul'] = 'Form Tambah Siswa';

        if ($session->get('user_position') == 'walikelas') {
            $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
            ->join('walikelas','walikelas.guru_id=guru.guru_id')
            ->where('users.user_id', $session->get('user_id'))->first();
            $data['idWakel'] = $wakel['kelas_id'];
        }

        return view('/admin/formTmbSiswa', $data);
    }
    public function aksiBuatSiswa()
    {
        $session = session(); 
        $isValidated = $this->validate([
            'siswa_nis' => 'required',
            'kelas_id' => 'required',
            'siswa_nama' => 'required',
            'siswa_email' => 'required',
            'siswa_position' => 'required'

        ]);

        if ($isValidated) {
            $SiswaModel = new SiswaModel();

            $SiswaModel -> insert([
                'siswa_nis'=>$this->request->getPost('siswa_nis'),
                'kelas_id'=>$this->request->getPost('kelas_id'),
                'siswa_nama'=>$this->request->getPost('siswa_nama'),
                'siswa_email'=>$this->request->getPost('siswa_email'),
                'siswa_position'=>$this->request->getPost('siswa_position')
                
            ]);
            session()->setFlashdata('message2', 'Data Create Success');
            return redirect()->to('/admin/siswa');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);

            return redirect('admin/siswa/createSiswa');
        }
    }
    public function editsiswa($id)
    {
        $session = session(); 

        $SiswaModel = new SiswaModel();
        $GuruModel = new GuruModel;
        $KelasModel = new KelasModel();
        $data['kelas'] = $KelasModel->findAll();
        $data['siswa'] = $SiswaModel->where('siswa_id', $id)->first();

        if ($session->get('user_position') == 'walikelas') {
            $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
            ->join('walikelas','walikelas.guru_id=guru.guru_id')
            ->where('users.user_id', $session->get('user_id'))->first();
            $data['idWakel'] = $wakel['kelas_id'];
        }

        return view('/admin/formEditSiswa', $data);
    }
    public function aksiEditSiswa($id)
    {
        $KelasModel = new KelasModel();
        
        $isValidated = $this->validate([
            'siswa_nis' => 'required',
            'kelas_id' => 'required',
            'siswa_nama' => 'required',
            'siswa_email' => 'required',
            'siswa_position' => 'required'
        ]);

        if ($isValidated) {
            $SiswaModel = new SiswaModel(); 
            $SiswaModel -> update($id, [
                'siswa_nis'=>$this->request->getPost('siswa_nis'),
                'kelas_id'=>$this->request->getPost('kelas_id'),
                'siswa_nama'=>$this->request->getPost('siswa_nama'),
                'siswa_email'=>$this->request->getPost('siswa_email'),
                'siswa_position'=>$this->request->getPost('siswa_position')
            ]);
            session()->setFlashdata('message2', 'Data Have Been Updated');
            return redirect()->to('/admin/siswa');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect('/admin/siswa/edit', $id);
    
        }
    }
    public function deletesiswa($id)
    {
        $SiswaModel = new SiswaModel();
        $data_siswa = $SiswaModel->find($id);

        if ($data_siswa) {
            $SiswaModel->delete($id);
            session()->setFlashdata('message2', 'Data Have Been Deleted');
            return redirect()->to(base_url('/admin/siswa'));
        }
    }

    public function import(){
        $KelasModel = new KelasModel();
        $data['kelas'] = $KelasModel->findAll();
        return view('/admin/formImport', $data);
    }

    public function importExcel()
    {
        $file = $this->request->getFile('file_excel');
        

        if ($file) {
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            $model = new SiswaModel();
            $modeluser = new UserModel();

            for ($row = 2; $row <= $highestRow; ++$row) {
                $data = [];
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    $data[] = $cellValue;
                }

                $cek = $model->where('siswa.siswa_nis', $data[0])->findAll();
                $cek2 = $modeluser->where('users.user_nik', $data[0])->findAll();
                if (count($cek)>0 && count($cek2)>0) {
                    session()->setFlashdata('message', 'Data Sudah Ada');
                    return redirect()->to(base_url('/admin/siswa'));
                }else {
                    $model->insert([
                        'siswa_nis' => $data[0],
                        'kelas_id' => $this->request->getPost('kelas_id'),
                        'siswa_nama' => $data[1],
                        'siswa_email' => $data[2],
                        'siswa_position' => "Siswa",
                        'user' => 1
                    ]);
                    $modeluser->insert([
                        'user_nik' => $data[0],
                        'user_name' => $data[1],
                        'user_email' => $data[2],
                        'user_position' => "Siswa",
                        'user_password' => password_hash( $this->request->getPost('user_password'), PASSWORD_DEFAULT),
                        'user_admin' => 0,
                        'user_skema' => 3,
                        'user_status' => 1,
                        'user_created_at' =>$this->request->getPost('created_at')
                    ]);
                }
                
            }
            session()->setFlashdata('message2', 'Data Have Been Added');
            return redirect()->to(base_url('admin/siswa'));
        }
    }    
    public function downloadTemplate()
{
    $templatePath = FCPATH . 'templates/template_siswa.xlsx';

    return $this->response->download($templatePath, null)->setFileName('template_siswa.xlsx');
}
}
