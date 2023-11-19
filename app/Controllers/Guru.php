<?php

namespace App\Controllers;
use App\Models\GuruModel;
use App\Models\UserModel;


use PhpOffice\PhpSpreadsheet\IOFactory;



class Guru extends BaseController
{
    public function index()
    {
        $GuruModel = new GuruModel();

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $Guru = $GuruModel->search($keyword);
        } 
        else {
            $Guru = $GuruModel;
        }

        $data_guru = $Guru->orderBy('guru_nama')->paginate(10, 'guru');
        $pager = $GuruModel->pager;
       
        $nomor = order_page_number($this->request->getVar('page_guru'), 10);
        return view('/admin/guru', compact('data_guru', 'pager', 'nomor'));
    }

    public function buatguru()
    {
        $data['judul'] = 'Form Tambah guru';

        return view('/admin/formTmbguru', $data);
    }

    public function aksiBuatguru()
    {
        $isValidated = $this->validate([
            'guru_nik' => 'required',
            'guru_nama' => 'required',
            'guru_email' => 'required',
            'guru_position' => 'required',
            'guru_wakel' => 'required'
        ]);

        if ($isValidated) {
            $GuruModel = new GuruModel;
            $GuruModel -> insert([
                'guru_nik'=>$this->request->getPost('guru_nik'),
                'guru_nama'=>$this->request->getPost('guru_nama'),
                'guru_email'=>$this->request->getPost('guru_email'),
                'guru_position'=>$this->request->getPost('guru_position'),
                'guru_wakel'=>$this->request->getPost('guru_wakel')
            ]);
            session()->setFlashdata('message2', 'Data Create Success');
            return redirect()->to('/admin/guru');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
           

            return redirect()->to('/admin/guru/Create');
        }
    }

    public function editguru($id)
    {
        $GuruModel = new GuruModel(); 
        $data['guru']= $GuruModel->where('guru_id', $id)->first();
        
        return view('/admin/formEditguru', $data);
    }

    public function aksiEditguru($id)
    {   
        $isValidated = $this->validate([
            'guru_nik' => 'required',
            'guru_nama' => 'required',
            'guru_email' => 'required',
            'guru_position' => 'required',
            'guru_wakel' => 'required'
        ]);

        if ($isValidated) {
            $GuruModel = new GuruModel();            
            $GuruModel -> update($id, [
                'guru_nik'=>$this->request->getPost('guru_nik'),
                'guru_nama'=>$this->request->getPost('guru_nama'),
                'guru_email'=>$this->request->getPost('guru_email'),
                'guru_position'=>$this->request->getPost('guru_position'),
                'guru_wakel'=>$this->request->getPost('guru_wakel')
            ]);
            session()->setFlashdata('message2', 'Data Have Been Updated');
            return redirect()->to('/admin/guru');
        }else {

            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect()->to( base_url('/admin/guru/edit/'. $id));
    
        }
    }

    public function deleteguru($id)
    {
        $GuruModel = new GuruModel();
        $data_guru = $GuruModel->find($id);

        if ($data_guru) {
            $GuruModel->delete($id);
            session()->setFlashdata('message2', 'Data Have Been Deleted');
            return redirect()->to(base_url('/admin/guru'));
        }
    }

    public function import(){
        return view('/admin/formImportGuru');
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

            $model = new GuruModel();
            $modeluser = new UserModel();

            for ($row = 2; $row <= $highestRow; ++$row) {
                $data = [];
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    $data[] = $cellValue;
                }
                $cek = $model->where('guru.guru_nik', $data[0])->findAll();
                $cek2 = $modeluser->where('users.user_nik', $data[0])->findAll();
                if (count($cek)>0 && count($cek2)>0) {
                    session()->setFlashdata('message', 'Data Sudah Ada');
                    return redirect()->to(base_url('/admin/guru'));
                }else {
                $model->insert([
                    'guru_nik' => $data[0],
                    'guru_nama' => $data[1],
                    'guru_email' => $data[2],
                    'guru_position' => "Guru",
                    'guru_wakel' => 0,
                    'user' => 1

                ]);
                $modeluser->insert([
                    'user_nik' => $data[0],
                    'user_name' => $data[1],
                    'user_email' => $data[2],
                    'user_position' => "Guru",
                    'user_password' => password_hash( "@SMKN2cmiGuru", PASSWORD_DEFAULT),
                    'user_admin' => 0,
                    'user_skema' => 2,
                    'user_status' => 1
                ]);
            }
            }
            session()->setFlashdata('message2', 'Data Have Been Added');
            return redirect()->to(base_url('admin/guru'));
        }
    }    
    public function downloadTemplateGuru()
{
    $templatePath = FCPATH . 'templates/template_guru.xlsx';

    return $this->response->download($templatePath, null)->setFileName('template_guru.xlsx');
}
}
