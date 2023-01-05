<?php

namespace App\Controllers\Admin;

use App\Models\{TransaksiModel, TransaksiDetailModel};
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->findAll()
        ];
        return view('admin/transaksi/index', $data);
    }

    public function detail($id){
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('admin/transaksi/detail', $data);
    }
}
