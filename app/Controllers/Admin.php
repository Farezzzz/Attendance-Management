<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        return view('start');
    }

    public function login()
    {
        return view('login');
    }
    
    public function admin()
    {

        return view('/admin/admin');
    }
   
}
