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
        $this->keranjangModel->save([
            'id_userFK' => user_id(),
            'id_produkFK' => $this->request->getVar('id_produk'),
            'qty' => 1,
            'total_harga' => $this->request->getVar('total_harga'),
            'subtotal_harga' => $this->request->getVar('total_harga') * 1
        ]);

        return redirect()->to(base_url('/keranjang'));
    }
}
