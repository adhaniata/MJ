<?php

namespace App\Controllers\Admin;

use App\Models\ProdukModel;
use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        //var_dump(in_groups('user')); die();

        $this->produkModel = new ProdukModel();
    }

    //untuk index
    public function index()
    {
        //return view('pages/home');
        $data = [
            'title' => 'Home|MJ Sport Collection',
            'produk' => $this->produkModel->getProduk()
        ];
        //echo view('Layout/header', $data);
        return view('admin/home/index', $data);
        //echo view('Layout/footer');
    }
    public function detail($slug_admin)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProduk($slug_admin)
        ];

        return view('admin/home/detail', $data);
    }
}
