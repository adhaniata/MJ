<?php

namespace App\Controllers\Admin;

use App\Models\{PengembalianModel, TransaksiDetailModel};
use App\Controllers\BaseController;

class Pengembalian extends BaseController
{
    protected $PengembalianModel;
    public function __construct()
    {
        $this->pengembalianModel = new PengembalianModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Pengembalian |MJ Sport Collection',
            'pengembalian' => $this->pengembalianModel->join('transaksi', 'transaksi.id_transaksi = pengembalian.id_transaksiFk')->get()->getResultArray()
        ];
        return view('admin/pengembalian/index', $data);
    }

    public function detail($id){
        $data = [
            'title' => 'Detail Pengembalian |MJ Sport Collection',
            'pengembalian' => $this->pengembalianModel->join('transaksi', 'transaksi.id_transaksi = pengembalian.id_transaksiFk')->where('id_transaksi', $id)->first(),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFk')->get()->getResultArray()
        ];
        return view('admin/pengembalian/detail', $data);
    }
}