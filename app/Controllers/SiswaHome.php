<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AbsenModel;

class SiswaHome extends BaseController
{
    public function home()
    {
        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Home',
            'kondisi' => true
        ];
        return view('siswa/home', $data);
    }

    public function checkin()
    {
        $userId = session()->get('user_id');
        $today = date('Y-m-d');
        $absenModel = new AbsenModel();
        $existingAbsen = $absenModel->where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }

        if ($existingAbsen) {
            return redirect()->back();
        }

        helper(['form']);
        $data = [
            'title' => 'Clock In'
        ];
        return view('siswa/checkin', $data);
    }

    public function checkout()
    {
        
        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Clock Out'
        ];
        return view('siswa/checkout', $data);
    }

    public function historyabsen()
    {
        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }
        helper(['form']);
        $data = [
            'title' => 'History Absen',
            'kondisi' => true
        ];
        return view('siswa/historyabsen', $data);
    }

    public function gantipassword()
    {
        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Ganti Password',
        ];
        return view('siswa/gantipassword', $data);
    }

    public function aksigantipassword()
    {
        if (session()->get('user_skema') <> 3) {
            return redirect()->back();
        }
        $session = session();
        $userModel = new UserModel();

        // Get the current user ID from session data
        $userId = $session->get('user_id');

        // Get the current password and the new password from form input
        $currentPassword = $this->request->getVar('current_password');
        $newPassword = $this->request->getVar('new_password');

        $validationRules = [
            'current_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password saat ini harus diisi.'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password baru harus diisi.',
                    'min_length' => 'Password baru harus memiliki minimal 8 karakter.'
                ]
            ]
        ];

        // Validate the input data
        if (!$this->validate($validationRules)) {
            // Set an error message and redirect to the password change page
            $error = $this->validator->getErrors();
            session()->setFlashdata('error', $error);
            return redirect()->to('/siswa/gantipassword');
        }

        // Get the user data from database based on the user ID
        $user = $userModel->find($userId);

        // Verify the current password
        $currentPasswordVerify = password_verify($currentPassword, $user['user_password']);

        if ($newPassword == $currentPassword) {
            // Set an error message and redirect to the password change page
            $session->setFlashdata('alert', 'Password baru tidak boleh sama dengan password saat ini');
            return redirect()->to('/siswa/gantipassword');
        }

        if ($currentPasswordVerify) {
            // Hash the new password and update the user data in database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userModel->update($userId, ['user_password' => $hashedPassword]);

            // Set a success message and redirect to the password change page
            $session->setFlashdata('msg', 'password berhasil di ganti');
            return redirect()->to('/siswa/home');
        } else {
            // Set an error message and redirect to the password change page
            $session->setFlashdata('msg', 'password Salah');
            return redirect()->to('/siswa/gantipassword');
        }
    }
}
