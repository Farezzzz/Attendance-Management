<?php

namespace App\Controllers;

require FCPATH . 'phpqrcode/qrlib.php';

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $nik = $this->request->getVar('nik');
        $password = $this->request->getVar('password');
        $data = $model->where('user_nik', $nik)->first();
        if ($data) {
            $pass = $data['user_password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass && $data['user_status'] == 1) {
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'user_nik'      => $data['user_nik'],
                    'user_position' => $data['user_position'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'user_admin'    => $data['user_admin'],
                    'user_skema'    => $data['user_skema'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                if ($data['user_admin'] == 1 || $data['user_position'] == 'walikelas') {
                    return redirect()->to('admin/home');
                } elseif ($data['user_skema'] == 3) {
                    return redirect()->to('siswa/home');    
                } elseif ($data['user_skema'] == 2) {
                    $userModel = new UserModel();
                    $userId = session()->get('user_id'); // Sesuaikan dengan cara Anda mendapatkan ID user/guru dari sesi atau informasi login

                    // Mengambil data user/guru berdasarkan ID user/guru yang sedang login
                    $user = $userModel->find($userId);

                    // Generate the QR code using the user_nik value
                    $data = $user['user_nik']; // Use the user_nik value as the data for the QR code
                    $filename = FCPATH . 'qrcodes/' . $user['user_nik'] . '.png';

                    \QRcode::png($data, $filename, QR_ECLEVEL_L, 10, 2);

                    // Redirect or perform further actions after generating the QR code
                    return redirect()->to('guru/home');
                }
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('msg', 'Wrong Password!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'NIK not Found!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
