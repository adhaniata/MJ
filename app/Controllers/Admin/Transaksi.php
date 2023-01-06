<?php

namespace App\Controllers\Admin;

use App\Models\{TransaksiModel, TransaksiDetailModel, KonfirmasiModel};
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
        $this->konfirmasiModel = new KonfirmasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->findAll()
        ];
        return view('admin/transaksi/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('admin/transaksi/detail', $data);
    }
    public function edit($id)
    {
        helper('form');
        $data = [
            'title' => 'Form Edit Data Transaksi',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id)
        ];
        return view('admin/transaksi/edit', $data);
    }
    public function update($id)
    {
        helper('form');
        //validasi input
        if (!$this->validate([
            //kalau menggunakan ini akan banyak error maka akan dikondisikan
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            'status_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'no_resi' => [
                'rules' => 'is_unique[transaksi.no_resi]',
                'errors' => [
                    'required' => '{field} no resi sudah ada.'
                ]
            ],
            'status_pengiriman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/transaksi/edit/' . $this->request->getVar('$id')))->withInput();
        } else {
            //method savenya
            $this->transaksiModel->save([
                'id_transaksi' => $id,
                'status_pembayaran' => $this->request->getVar('status_pembayaran'),
                'no_resi' => $this->request->getVar('no_resi'),
                'status_pengiriman' => $this->request->getVar('status_pengiriman')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/admin/transaksi'));
        }
    }
    public function konfirmasi($id)
    {
        helper('form');
        $data = [
            'title' => 'Konfirmasi',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->konfirmasiModel->find($id)
        ];
        return view('admin/transaksi/konfirmasi', $data);
    }
    public function updateKonfirmasi($id)
    {
        helper('form');
        //validasi input
        if (!$this->validate([
            'validasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/transaksi/konfirmasi/' . $this->request->getVar('$id')))->withInput();
        } else {
            //method savenya
            $this->konfirmasiModel->save([
                'id_konfirmasi' => $id,
                'validasi' => $this->request->getVar('validasi')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');
            return redirect()->to(base_url('/admin/transaksi'));
        }
    }
}
