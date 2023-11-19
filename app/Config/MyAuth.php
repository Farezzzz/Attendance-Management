<?php

namespace App\Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Config\Services;
use App\Models\SiswaModel;
use App\Models\UserModel;

class MyAuth extends BaseService
{
    /**
     * Konfigurasi auth
     */
    public static function authConfig(): array
    {
        return [
            'model' => [
                'siswa' => SiswaModel::class,
                'users' => UserModel::class,
            ],
            'fields' => [
                'identity' => 'username',
                'password' => 'password',
            ],
        ];
    }

    /**
     * Mendapatkan instance dari auth service
     */
    public static function auth(): \CodeIgniter\Auth\Authenticate
    {
        return Services::authenticate(self::authConfig());
    }
}
