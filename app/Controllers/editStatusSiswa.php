<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\SiswaModel;

class editStatusSiswa extends BaseController
{
    public function editstatus($d)
    {
        $AbsenModel = new AbsenModel();
        $data_siswa = $AbsenModel->where('user_id', $d)->first();
        $title = 'Edit Status Siswa';
        return view('guru/editstatus', compact('data_siswa', 'title'));
    }
    public function update()
    {
        $isValidated = $this->validate([

            'tipe' => 'required',
        ]);

        if ($isValidated) {
            $AbsenModel = new AbsenModel();
            $AbsenModel->update($this->request->getPost('user_id'), [
                'tipe' => $this->request->getPost('tipe'),
            ]);

            return redirect('guru/datasiswa');
        } else {
            $error = $this->validator->getErrors();

            session()->setFlashdata('error', $error);

            return redirect()->to(base_url('guru/editstatus/' . $this->request->getPost('user_id')));
        }
    }
    public function editstatusfailed()
    {  return redirect()->to(base_url('guru/datasiswa'));
    }
}
