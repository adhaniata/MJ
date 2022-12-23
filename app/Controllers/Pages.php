<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Pages extends BaseController
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
            'produk' => $this->produkModel->getProduk()
        ];
        //echo view('Layout/header', $data);
        return view('pages/index', $data);
        //echo view('Layout/footer');
    }

    public function detail($slug_produk)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProduk($slug_produk)
        ];
        return view('pages/produk', $data);
    }
}
