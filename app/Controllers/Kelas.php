<?php

namespace App\Controllers;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\WalikelasModel;


class Kelas extends BaseController{
    public function kelas()
    {

        $KelasModel = new KelasModel();

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $Kelas = $KelasModel->search($keyword);
        } 
        else {
            $Kelas = $KelasModel;
        }
        $data_kelas = $Kelas->paginate(10, 'kelas');
        $pager = $KelasModel->pager;
        
        $nomor = order_page_number($this->request->getVar('page_kelas'), 10);
        
        return view('/admin/kelas', compact('data_kelas', 'pager', 'nomor'));
    }
    public function buatkelas()
    {

        $KelasModel = new KelasModel;
        $data['judul'] = 'Form Tambah Kelas';

        return view('/admin/formTmbKelas', $data);
    }
    public function aksiBuatKelas()
    {

        $isValidated = $this->validate([
            'kelas' => 'required'
        ]);

        if ($isValidated) {
            $KelasModel = new KelasModel;
            $KelasModel -> insert([
                'kelas'=>$this->request->getPost('kelas')
            ]);
            session()->setFlashdata('message2', 'Data Created Success');

            return redirect()->to('/admin/kelas');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);

            return redirect('admin/kelas/createKelas');
        }
    }
    public function editkelas($id)
    {

        $KelasModel = new KelasModel(); 
        $data_kelas = $KelasModel->where('kelas_id', $id)->first();
        
        return view('/admin/formEditKelas', compact('data_kelas'));
    }
    public function aksiEditKelas($id)
    {

        $isValidated = $this->validate([
            'kelas' => 'required'
        ]);

        if ($isValidated) {
            $KelasModel = new KelasModel();            
            $KelasModel -> update($id, [
                'kelas'=>$this->request->getPost('kelas')
            ]);
            session()->setFlashdata('message2', 'Data Have Been Updated');
            return redirect()->to('/admin/kelas');
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect('/admin/kelas/edit', $id);
    
        }
    }
    public function deletekelas($id)
    {

        $KelasModel = new KelasModel();
        $data_kelas = $KelasModel->find($id);

        if ($data_kelas) {
            $KelasModel->delete($id);
            session()->setFlashdata('message2', 'Data Have Been Deleted');
            return redirect()->to(base_url('/admin/kelas'));
        }
    }

    public function datasiswa($id){

        $KelasModel = new KelasModel();
        $SiswaModel = new SiswaModel();
        $WalikelasModel = new WalikelasModel();
        
        $siswa = $KelasModel->join('siswa','siswa.kelas_id=kelas.kelas_id')->where('siswa.kelas_id', $id);
        $data_siswa = $siswa->orderBy('siswa_nama')->paginate(10, 'siswa');
        $pager = $KelasModel->join('siswa','siswa.kelas_id=kelas.kelas_id')->pager;
        
        $nomor = order_page_number($this->request->getVar('page_siswa'), 10);
        $data_guru = $WalikelasModel->join('guru','guru.guru_id=walikelas.guru_id')->where('walikelas.kelas_id', $id)->first();

        return view('/admin/datasiswa', compact('data_siswa', 'data_guru', 'pager', 'nomor'));
    }
}