<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\ValidasiModel;


class User extends BaseController
{
    public function index()
    {
        $session = session();

        
        $UserModel = new UserModel();
        $GuruModel = new GuruModel();
        $keyword = $this->request->getVar('keyword');
        $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
                        ->join('walikelas','walikelas.guru_id=guru.guru_id')
                        ->where('users.user_id', $session->get('user_id'))->first();

        if ($keyword) {
            if ($session->get('user_position') == 'walikelas') {
                $User = $UserModel->join('siswa', 'siswa.siswa_nis=users.user_nik', 'left')
                        ->where('siswa.kelas_id', $wakel['kelas_id'])->search($keyword);
            }
            else {
                $User = $UserModel->search($keyword);
            }      
        } 
        else {
            if ($session->get('user_position') == 'walikelas') {
                $User = $UserModel->join('siswa', 'siswa.siswa_nis=users.user_nik', 'left')
                        ->where('siswa.kelas_id', $wakel['kelas_id']);
            }
            else {
                $User = $UserModel;
            }
        }

        $data_user = $User->paginate(10, 'users');
        $pager = $UserModel->pager;
       
        $nomor = order_page_number($this->request->getVar('page_users'), 10);
        
        return view('/admin/user', compact('data_user', 'pager', 'nomor'));
    }
    public function validasi(){
        $session = session();


        $ValidasiModel = new ValidasiModel();
        $data_validasi = $ValidasiModel->findAll();
        
        return view('/admin/formValidasi', compact('data_validasi'));
    }
    public function aksiValidasi(){
        $session = session();


        $isValidated = $this->validate([
            'nama' => 'required'
        ]);
        if ($isValidated) {
            $jenis = $this->request->getPost('nama');
            if ($jenis == "Guru") {
                return redirect()->to('admin/user/Createguru');
            }else{
                return redirect()->to('admin/user/Createsiswa');
            }
        }else {
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);

            return redirect('admin/user/validasi');
        }
        
    }
    public function buatuserguru()
    {
        $session = session();


        $data['judul'] = 'Form Tambah User';

        $GuruModel = new GuruModel();
        $UserModel = new UserModel();

        $data['user'] = $UserModel->findAll();
        $data['guru'] = $GuruModel->where('user', 0)->findAll();

        return view('/admin/formTmbuserguru', $data);
    }

    public function aksiBuatuserguru()
    {
        $session = session();


        
        $isValidated = $this->validate([
            'user_nik' => 'required',
            'user_name' => 'required',
            'user_email' => 'required',
            'user_position' => 'required',
            'user_password' => 'required',
            'user_skema' => 'required',
            'user_status' => 'required'
            
        ]);

        if ($isValidated) {
            $UserModel = new UserModel(); 

            $UserModel -> insert([
                'user_nik'=>$this->request->getPost('user_nik'), 
                'user_name'=>$this->request->getPost('user_name'),
                'user_email'=>$this->request->getPost('user_email'),
                'user_position'=>$this->request->getPost('user_position'),
                'user_password'=>password_hash( $this->request->getPost('user_password'), PASSWORD_DEFAULT),
                'user_admin'=> 0,
                'user_skema'=>$this->request->getPost('user_skema'),
                'user_status'=>$this->request->getPost('user_status')
            
            ]);

            $GuruModel = new GuruModel();
            $nikguru = $this->request->getPost('user_nik');
            $idguru = $GuruModel->select('guru.guru_id')->where('guru_nik', $nikguru)->first();

            $GuruModel -> update($idguru, [
                'user' => 1
            ]);
            session()->setFlashdata('message2', 'Data Create Success');
            return redirect()->to('/admin/user');
        }else {

            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect()->to( base_url('/admin/user/Createguru/'));
        }
    }

    public function buatusersiswa()
    {
        $session = session();


        $data['judul'] = 'Form Tambah User';

        $SiswaModel = new SiswaModel();
        $UserModel = new UserModel();
        $KelasModel = new KelasModel();
        $GuruModel = new GuruModel();

        $wakel = $GuruModel->join('users','users.user_nik=guru.guru_nik')
        ->join('walikelas','walikelas.guru_id=guru.guru_id')
        ->where('users.user_id', $session->get('user_id'))->first();
        if ($session->get('user_position') == 'walikelas') {
            $data['idWakel'] = $wakel['kelas_id'];
        }
        $data['user'] = $UserModel->findAll();
        if ($session->get('user_position') == 'walikelas') {
            $data['siswa'] = $SiswaModel->where('user', 0)->where('siswa.kelas_id', $data['idWakel'])->findAll();
        }

        $data['siswa'] = $SiswaModel->where('user', 0)->findAll();

        return view('/admin/formTmbusersiswa', $data);
    }

    public function aksiBuatusersiswa()
    {
        $session = session();


        $isValidated = $this->validate([
            'user_nik' => 'required',
            'user_name' => 'required',
            'user_email' => 'required',
            'user_position' => 'required',
            'user_password' => 'required',
            'user_skema' => 'required',
            'user_status' => 'required'
    
        ]);

        if ($isValidated) {
            $UserModel = new UserModel(); 

            $UserModel -> insert([
                'user_nik'=>$this->request->getPost('user_nik'),
                'user_name'=>$this->request->getPost('user_name'),
                'user_email'=>$this->request->getPost('user_email'),
                'user_position'=>$this->request->getPost('user_position'),
                'user_password'=>password_hash( $this->request->getPost('user_password'), PASSWORD_DEFAULT),
                'user_admin'=> 0,
                'user_skema'=>$this->request->getPost('user_skema'),
                'user_status'=>$this->request->getPost('user_status')
               
            ]);

            $SiswaModel = new SiswaModel();
            $nissiswa = $this->request->getPost('user_nik');
            $id = $SiswaModel->select('siswa.siswa_id')->where('siswa_nis', $nissiswa)->first();

            $SiswaModel -> update($id, [
                'user' => 1
            ]);
            session()->setFlashdata('message2', 'Data Create Success');
            return redirect()->to('/admin/user');
        }else {

            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect()->to( base_url('/admin/user/Createsiswa/'));
        }
    }

    public function edituser($id)
    {
        $session = session();



        $UserModel = new UserModel(); 
        $data['user']= $UserModel->where('user_id', $id)->first();    
        
        return view('/admin/formEdituser', $data);
    }

    public function aksiEdituser($id)
    {
        $session = session();


        $isValidated = $this->validate([
            'user_name' => 'required',
            'user_position' => 'required',
            'user_password' => 'required',
            'user_admin' => 'required',
            'user_skema' => 'required',
            'user_status' => 'required'
        
        ]);

        if ($isValidated) {
            $UserModel = new UserModel();    
            $SiswaModel = new SiswaModel();        
            $UserModel -> update($id, [
                'user_name'=>$this->request->getPost('user_name'),
                'user_position'=>$this->request->getPost('user_position'),
                'user_password'=>password_hash( $this->request->getPost('user_password'), PASSWORD_DEFAULT),
                'user_admin'=>$this->request->getPost('user_admin'),
                'user_skema'=>$this->request->getPost('user_skema'),
                'user_status'=>$this->request->getPost('user_status')
            ]);
        
            session()->setFlashdata('message2', 'Data Have Been Updated');
            return redirect()->to('/admin/user');
        }else {

            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
    
            return redirect()->to( base_url('/admin/user/edit/'. $id));
    
        }
    }

    public function deleteuser($id)
    {
        $session = session();


        $UserModel = new UserModel();
 
        $data_user = $UserModel->find($id);;

        if ($data_user) {

            // ambil data bf update
            $userold = $UserModel->where('user_id', $id)->first();
            $nikguruold = $userold['user_nik'];
            $nissiswaold = $userold['user_nik'];

            // update guru old
            $GuruModel = new GuruModel();

            $idguru = $GuruModel->select('guru.guru_id')->where('guru_nik', $nikguruold)->first();
            $GuruModel -> update($idguru, [
                'user' => 0
            ]);
             
            // update siswa old
            $SiswaModel = new SiswaModel();
            $idsiswa = $SiswaModel->select('siswa.siswa_id')->where('siswa_nis', $nissiswaold)->first();
            $SiswaModel -> update($idsiswa, [
                'user' => 0
            ]);

            // delete data
            $UserModel->delete($id);

            session()->setFlashdata('message2', 'Data Have Been Deleted');
            return redirect()->to(base_url('/admin/user'));
        }
    }
}
