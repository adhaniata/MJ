<?php

namespace App\Controllers;

//use App\Models\TransaksiModel;
use App\Models\{KeranjangModel, ProdukModel, TransaksiModel, OngkirModel, TransaksiDetailModel};

class Transaksi extends BaseController
{
    protected $TransaksiModel;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->ongkirModel = new OngkirModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Transaksi Saya |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/index', $data);
    }

    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([

            //untuk menampilkan bahasa error yang kita inginkan
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('/keranjang/checkout'))->withInput();
        } else {
            //untuk savenya
            $transaksi = $this->transaksiModel->save([
                'id_userFK' => user_id(),
                'ongkir' => $this->request->getVar('ongkos_kirim'),
                'nama' => $this->request->getVar('nama'),
                'telp' => $this->request->getVar('telp'),
                'alamat' => $this->request->getVar('alamat'),
                'total_tagihan' => $this->request->getVar('total_tagihan'),
                'status_pembayaran' => 'MENUNGGU PEMBAYARAN',
            ]);

            // ambil keranjang user
            $keranjang = $this->keranjangModel->where('id_userFK',user_id())->join('produk', 'produk.id_produk = keranjang.id_produkFK')->get()->getResultArray();

            // masukkan data keranjang ke dalam table transaksi detail
            foreach ($keranjang as $k) {
                $transaksi_detail = $this->transaksiDetailModel->save([
                    'id_transaksiFK' => $this->transaksiModel->getInsertID(),
                    'id_produkFK' => $k['id_produkFK'],
                    'total_harga' => $k['total_harga'],
                    'qty' => $k['qty'],
                    'subtotal_harga' => $k['subtotal_harga']
                ]);

                // update stok produk yang sudah terjual
                $this->produkModel->where('id_produk', $k['id_produkFK'])->decrement('stok', $k['qty']);
            }

            // delete keranjang user
            $this->keranjangModel->where('id_userFK', user_id())->delete();

            session()->setFlashdata('pesan', 'Data Membuat Pesanan, Silahkan Bayar Sesuai Nominal dan Sertakan Bukti Pembayaran');
            return redirect()->to(base_url('/transaksi'));
        }
    }

    public function detail($id){
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('transaksi/detail', $data);
    }
}