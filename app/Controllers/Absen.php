<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AbsenModel;
 
class Absen extends Controller
{
    public function clockin()
    {
        $session = session();

        $absenModel = new AbsenModel();
        $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'));
        $absen = $absenModel->where($where)->first();
        if(isset($absen['clockin'])){
            redirect()->route('home');
        }

        helper(['form']);
        //set rules validation form
        $rules = [
            'lat'          => 'required|min_length[5]|max_length[50]',
            'long'         => 'required|min_length[5]|max_length[50]',
            'foto' => [
				'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
				'errors' => [
					'uploaded' => 'Harus Ada Foto Selfie',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png'
				]
			]
        ];

        // var_dump($this->request->getFile('foto'));exit;
         
        if($this->validate($rules)){
            $model = new AbsenModel();

            $dataFoto = $this->request->getFile('foto');
		    $fileName = $dataFoto->getRandomName();

            $image = \Config\Services::image()
                ->withFile($dataFoto)
                ->fit(300, 300, 'center')
                ->reorient()
                ->save('img/clockin/'. $fileName);

            $data = [
                'user_id'     => $session->get('user_id'),
                'tanggal'     => date('Y-m-d'),
                'clockin'     => date('Y-m-d H:i:s'),
                'foto'        => $fileName,
                'tipe'        => $this->request->getVar('tipe'),
                'latitude'    => $this->request->getVar('lat'),
                'longitude'   => $this->request->getVar('long')
            ];

            if(!isset($absen['clockin'])){
                $model->save($data);
                // $dataFoto->move('img/clockin/', $fileName);
            }

            return redirect()->to('siswa/home');
        }else{
            $session->setFlashdata('msgci', $this->validator->listErrors());
            return redirect()->to('siswa/clockin');
        }
         
    }

    public function clockout()
    {
        $session = session();
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'lat'          => 'required|min_length[5]|max_length[50]',
            'long'         => 'required|min_length[5]|max_length[50]',
            'foto' => [
				'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
				'errors' => [
					'uploaded' => 'Harus Ada Foto Selfie',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png'
				]
			]
        ];

        // var_dump($this->request->getFile('foto'));exit;
         
        if($this->validate($rules)){
            $model = new AbsenModel();

            $where = array('user_id' => $session->get('user_id'), 'tanggal' => date('Y-m-d'), 'clockout' => NULL);

            $id = $model->where($where)->first();

            $dataFoto = $this->request->getFile('foto');
		    $fileName = $dataFoto->getRandomName();

            $image = \Config\Services::image()
                ->withFile($dataFoto)
                ->fit(300, 300, 'center')
                ->reorient()
                ->save('img/clockout/'. $fileName);

            $data = [
                'clockout'        => date('Y-m-d H:i:s'),
                'foto_out'        => $fileName,
                'latitude_out'    => $this->request->getVar('lat'),
                'longitude_out'   => $this->request->getVar('long'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
            $model->update($id['absen_id'], $data);
            // $dataFoto->move('img/clockout/', $fileName);

            return redirect()->to('siswa/home');
        }else{
            $session->setFlashdata('msgci', $this->validator->listErrors());
            return redirect()->to('siswa/clockout');
        }
         
    }
 
}