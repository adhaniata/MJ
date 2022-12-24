<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        //return view('pages/home');
        $data = [
            'title' => 'Home|MJ Sport Collection',
            'produk' => $this->produkModel->getProdukAdmin()
        ];
        //echo view('Layout/header', $data);
        return view('home/index', $data);
        //echo view('Layout/footer');
    }
}
