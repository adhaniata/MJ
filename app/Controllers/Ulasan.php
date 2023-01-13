<?php

namespace App\Controllers;

//use App\Models\TransaksiModel;
use App\Models\{ProdukModel, TransaksiModel, UlasanModel, TransaksiDetailModel};

class Ulasan extends BaseController
{
    protected $UlasanModel;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->produkModel = new ProdukModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
        $this->ulasanModel = new UlasanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Ulasan Produk |MJ Sport Collection',
            'ulasan' => $this->ulasanModel->getUlasan(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/ulasan', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //untuk menampilkan bahasa error yang kita inginkan
            'isi_ulasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('transaksi/ulasan/' . $this->request->getVar('id_transaksiFK')))->withInput();
        }
        //untuk savenya
        $this->ulasanModel->save([
            'id_transaksiFK' => $this->request->getVar('id_transaksiFK'),
            'isi_ulasan' => $this->request->getVar('isi_ulasan')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasi Ditambahkan, Terimakasih Atas Ulasannya');
        return redirect()->to(base_url('home/index'));
    }
}
