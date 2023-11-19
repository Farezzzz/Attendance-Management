<?php

namespace App\Controllers;

use App\Models\AbsenModel;

use App\Models\SiswaModel;
use App\Models\UserModel;


class Home extends BaseController
{
    public function index()
    {
        return view('start');
    }

    public function login()
    {
        return view('login');
    }

    public function homeGuru()
    {
        if(session()->get('user_skema') <> 2 && session()->get('user_skema') <> 4 ){
            return redirect()->back();
        }
        $AbsenModel = new AbsenModel();
        $result = $AbsenModel->select('count(tipe) as tipe')->first();
        $data['sum'] = $result['tipe'];
        $data['title'] = "Home";
        return view('guru/home', $data);
    }

    public function listabsen()
    {
        if(session()->get('user_skema') <> 2 && session()->get('user_skema') <> 4){
            return redirect()->back();
        }
        helper(['form']);
        $data = [
            'title' => 'List Absen'
        ];
        return view('guru/listabsen', $data);
    }

    public function rekapabsen()
    {
        if(session()->get('user_skema') <> 2 && session()->get('user_skema') <> 4){
            return redirect()->back();
        }
        helper(['form']);
        $data = [
            'title' => 'Rekap Absen'
        ];
        return view('guru/rekapabsen', $data);
    }

    public function rekapabsentabel()
    {
        if(session()->get('user_skema') <> 2 && session()->get('user_skema') <> 4){
            return redirect()->back();
        }
        helper(['form']);
        $data = [];
        return view('rekapabsentabel', $data);
    }


    function total()
    {
        $b[data] = $this->homeModel->tampil_kota();
        $this->load->view('guru/home', $b);
    }

    public function datasiswa()
    {
        if(session()->get('user_skema') <> 2 && session()->get('user_skema') <> 4){
            return redirect()->back();
        }
        $UserModel = new UserModel();

        helper(['form']);
        $data = [
            'title' => 'Data Siswa'
        ];
        return view('guru/dataSiswa', $data);
    }
}
