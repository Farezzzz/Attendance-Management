<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\AbsenModel;

class CekSiswa implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $UserModel = new UserModel;
        $data = $UserModel->where('user_id', session('user_id'))->first();
        $AbsenModel=new AbsenModel;
        $cek=$AbsenModel->where('user_id',session('user_id'))->first();

        if ($data == NULL) {
            return redirect()->to('login');
        }

        if ($data['user_admin'] == 0) {
            return redirect()->to('siswa/home');
        }

        if($cek['user_id']==1 && $cek['user_id']==2 && $cek['user_id']==3){
            return redirect()->to('siswa/home');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
