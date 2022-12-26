<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Keranjang extends BaseController
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
            'title' => 'Keranjang |MJ Sport Collection',
            'produk' => $this->produkModel->getProduk()
        ];
        return view('keranjang/index', $data);
    }
}
