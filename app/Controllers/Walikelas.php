<?php

namespace App\Controllers;
use App\Models\WalikelasModel;
use App\Models\KelasModel;
use App\Models\GuruModel;

class Walikelas extends BaseController{
    public function walikelas()
    {

        $WalikelasModel = new WalikelasModel();

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $Walikelas = $WalikelasModel->join('guru','guru.guru_id=walikelas.guru_id')
            ->join('kelas','kelas.kelas_id=walikelas.kelas_id')->search($keyword);
        } 
        else {
            $Walikelas = $WalikelasModel->join('guru','guru.guru_id=walikelas.guru_id')
            ->join('kelas','kelas.kelas_id=walikelas.kelas_id');
        }

        $data_walikelas = $Walikelas->orderBy('kelas')->paginate(10, 'walikelas');
        $pager = $WalikelasModel->pager;
        
        $nomor = order_page_number($this->request->getVar('page_walikelas'), 10);

        return view('/admin/walikelas', compact('data_walikelas', 'pager', 'nomor'));
    }
    public function buatwalikelas()
    {

        $KelasModel = new KelasModel();
        $GuruModel = new GuruModel();

        $data['kelas'] = $KelasModel->where('kelas_wakel', 0)->findAll();
        $data['guru'] = $GuruModel->where('guru_wakel', 0)->findAll();

        $data['judul'] = 'Form Tambah Walikelas';

        return view('/admin/formTmbWalikelas', $data);
    }
    public function aksiBuatWalikelas()
    {

        $isValidated = $this->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($isValidated) {
            $WalikelasModel = new WalikelasModel();

            $WalikelasModel -> insert([
                'guru_id'=>$this->request->getPost('guru_id'),
                'kelas_id'=>$this->request->getPost('kelas_id'),
            ]);
            
            $GuruModel = new GuruModel();
            $idguru = $this->request->getPost('guru_id');
            $GuruModel -> update($idguru, [
                'guru_position' => 'walikelas',
                'guru_wakel' => 1
            ]);


            $KelasModel = new KelasModel();
            $idkelas = $this->request->getPost('kelas_id');
            $KelasModel -> update($idkelas, [
                'kelas_wakel' => 1
            ]);

            session()->setFlashdata('message2', 'Data Created Success');

            
            return redirect()->to('/admin/walikelas');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);

            return redirect('admin/walikelas/createWalikelas');
        }
    }
    public function editwalikelas($id)
    {

        $WalikelasModel = new WalikelasModel();
        $data['walikelas'] = $WalikelasModel->where('walikelas_id', $id)->first();

        $KelasModel = new KelasModel();
        $GuruModel = new GuruModel();

        $data['guru'] = $GuruModel->where('guru_wakel', 0)->findAll();
        $data['gurunow'] = $GuruModel->where('guru_id', $data['walikelas']['guru_id'])->first();

        $data['kelas'] = $KelasModel->where('kelas_wakel', 0)->findAll();
        $data['kelasnow'] = $KelasModel->where('kelas_id', $data['walikelas']['kelas_id'])->first();
        

        $data['judul'] = 'Form Edit Walikelas';

        return view('/admin/formEditWalikelas', $data);
    }
    public function aksiEditwalikelas($id)
    { 

        $isValidated = $this->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($isValidated) {

            $WalikelasModel = new WalikelasModel();
            // ambil data walikelas bf update
            $walikelasold = $WalikelasModel->where('walikelas_id', $id)->first();
            $idguruold = $walikelasold['guru_id'];
            $idkelasold = $walikelasold['kelas_id'];

            // update guru old
            $GuruModel = new GuruModel();
            $GuruModel -> update($idguruold, [
                'guru_wakel'=> 0,
                'guru_position'=> 'guru'
            ]);
             
            // update kelas old
            $KelasModel = new KelasModel();
            $KelasModel -> update($idkelasold, [
                'kelas_wakel' => 0
            ]);
            
            // update walikelas
            $WalikelasModel -> update($id, [
                'guru_id'=>$this->request->getPost('guru_id'),
                'kelas_id'=>$this->request->getPost('kelas_id'),
            ]);

            // update guru new
            $GuruModel = new GuruModel();
            $idgurunew = $this->request->getPost('guru_id');
            $GuruModel -> update($idgurunew, [
                'guru_wakel'=> 1,
                'guru_position'=> 'walikelas'

            ]);

            // update kelas new
            $KelasModel = new KelasModel();
            $idkelasnew = $this->request->getPost('kelas_id');
            $KelasModel -> update($idkelasnew, [
                'kelas_wakel' => 1
            ]);

            session()->setFlashdata('message2', 'Data Have Been Updated');


            return redirect()->to('/admin/walikelas');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect('/admin/walikelas/edit', $id);
    
        }
    }
    public function deletewalikelas($id)
    {

        $WalikelasModel = new WalikelasModel();
        $data_walikelas = $WalikelasModel->find($id);

        if ($data_walikelas) {

            // ambil data walikelas bf update
            $walikelasold = $WalikelasModel->where('walikelas_id', $id)->first();
            $idguruold = $walikelasold['guru_id'];
            $idkelasold = $walikelasold['kelas_id'];

            // update guru old
            $GuruModel = new GuruModel();
            $GuruModel -> update($idguruold, [
                'guru_wakel'=> 0,
                'guru_position'=> 'guru'
            ]);
             
            // update kelas old
            $KelasModel = new KelasModel();
            $KelasModel -> update($idkelasold, [
                'kelas_wakel' => 0
            ]);

            // delete data
            $WalikelasModel->delete($id);

            session()->setFlashdata('message2', 'Data Have Been Deleted');
            return redirect()->to(base_url('/admin/walikelas'));
        }
    }
}