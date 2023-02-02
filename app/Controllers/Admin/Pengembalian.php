<?php

namespace App\Controllers\Admin;

use App\Models\{PengembalianModel, TransaksiModel, TransaksiDetailModel};
use App\Controllers\BaseController;

class Pengembalian extends BaseController
{
    protected $PengembalianModel;
    public function __construct()
    {
        $this->pengembalianModel = new PengembalianModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
        $this->transaksiModel = new TransaksiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Pengembalian |MJ Sport Collection',
            'pengembalian' => $this->pengembalianModel->select('transaksi.id_transaksi, transaksi.nama, transaksi.telp, pengembalian.id_transaksiFK, pengembalian.validasi, pengembalian.status')->join('transaksi', 'transaksi.id_transaksi = pengembalian.id_transaksiFk')->get()->getResultArray(),
            'validasi_pengembalian' => $this->pengembalianModel->getPengembalian()
        ];
        return view('admin/pengembalian/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pengembalian |MJ Sport Collection',
            'pengembalian' => $this->pengembalianModel->join('transaksi', 'transaksi.id_transaksi = pengembalian.id_transaksiFk')->where('id_transaksi', $id)->first(),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFk')->get()->getResultArray()
        ];
        return view('admin/pengembalian/detail', $data);
    }
    public function update($id)
    {
        helper('form');
        //method savenya
        // $this->pengembalianModel->save([
        //     'id_pengembalian' => $id,
        //     'validasi' => $this->request->getVar('validasi'),
        //     'status' => $this->request->getVar('status'),
        // ]);

        if ($this->request->getVar('validasi') == 'Tidak Valid') {
            $this->pengembalianModel->save([
                'id_pengembalian' => $id,
                'validasi' => $this->request->getVar('validasi'),
            ]);
            $this->transaksiModel->save([
                'id_transaksi' => $this->request->getVar('id_transaksiFK'),
                'status_pengiriman' => 'DITERIMA',
            ]);
        } else {
            $this->pengembalianModel->save([
                'id_pengembalian' => $id,
                'validasi' => $this->request->getVar('validasi'),
                'status' => $this->request->getVar('status'),
            ]);
        }


        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to(base_url('/admin/pengembalian'));
    }
}
