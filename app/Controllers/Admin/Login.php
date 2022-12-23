<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Login extends BaseController
{
    //untuk index
    public function login()
    {
        $data = [
            'title' => 'Login Admin|MJ Sport Collection'
        ];
        //echo view('Layout/header', $data);
        return view('admin/home/login', $data);
        //echo view('Layout/footer');
    }
}
