<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users'; // tabel pertama
    protected $primaryKey = 'user_id'; // primary key tabel pertama
    protected $allowedFields = ['user_nik','user_name','user_email','user_position','user_password','user_created_at']; // field yang diizinkan pada tabel pertama

    public function verify_login($username, $password)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->join('siswa', 'siswa.user_nis = users.user_nis') // join dengan tabel kedua (siswa) berdasarkan kolom username
            ->where('users.user_nik', $username)
            ->get();

        $user = $query->getRow(); // mengambil satu baris hasil query

        // jika user ditemukan dan password benar, maka return data user
        if ($user && password_verify($password, $user->password)) {
            unset($user->password); // menghapus password dari data user
            return $user;
        }

        return false; // jika user tidak ditemukan atau password salah, maka return false
    }
}
