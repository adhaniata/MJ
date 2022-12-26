<?php

namespace App\Controllers;

use App\Models\KeranjangModel;

class Keranjang extends BaseController
{
    protected $KeranjangModel;
    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Keranjang |MJ Sport Collection',
            'keranjang' => $this->keranjangModel->getKeranjang()
        ];
        return view('keranjang/index', $data);
    }
    public function tambahKeranjang()
    {
    }
}
