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
            'produk' => $this->produkModel->getProdukAdmin(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        //echo view('Layout/header', $data);
        return view('home/index', $data);
        //echo view('Layout/footer');
    }
    public function detail($slug_produk)
    {
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProdukAdmin($slug_produk)
        ];
        return view('home/detail', $data);
    }
}
