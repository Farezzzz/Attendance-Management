<?php

namespace App\Controllers;

use CodeIgniter\Controller;

require FCPATH . 'phpqrcode/qrlib.php';

use App\Models\GuruModel;
use App\Models\UserModel;

class QRCode extends Controller
{
    public function index()
    {
        helper('form');
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $userNiks = array_column($users, 'user_nik');

        // Select a random user_nik from the array
        $userNik = $userNiks[array_rand($userNiks)];

        // Menyiapkan data yang akan dikirim ke view
        $data = [
            'user_nik' => $userNik
        ];

        echo view('qr/qr_scanner', $data);
    }

    public function scan()
    {
        $data['result'] = $this->request->getVar('qr_data');
        echo view('qr/qr_result', $data);
    }

    public function generateQrCode()
    {
        $userModel = new UserModel();

        // Mendapatkan ID user/guru yang sedang login dari sesi atau informasi login
        $userId = session()->get('user_id'); // Sesuaikan dengan cara Anda mendapatkan ID user/guru dari sesi atau informasi login

        // Mengambil data user/guru berdasarkan ID user/guru yang sedang login
        $user = $userModel->find($userId);

        if ($user !== null) {
            $data = $user['user_nik']; // Menggunakan data "user_nik" dari user/guru dalam URL QR code
            $filename = FCPATH . 'qrcodes/' . $user['user_nik'] . '.png'; // Menggunakan data dari user/guru dalam nama file QR code

            \QRcode::png($data, $filename, QR_ECLEVEL_L, 10, 2); // Generate QR code dan simpan ke dalam file gambar di dalam folder "qrcodes"
        }
    }

    public function showQrCode()
    {
        return view('guru/home');
    }
}
