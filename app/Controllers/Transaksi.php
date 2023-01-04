<?php

namespace App\Controllers;

//use App\Models\TransaksiModel;
use App\Models\{KeranjangModel, ProdukModel, TransaksiModel, OngkirModel};

class Transaksi extends BaseController
{
    protected $TransaksiModel;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->ongkirModel = new OngkirModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Form Pembelian|MJ Sport Collection',
            'transaksi' => $this->transaksiModel->getTransaksi(),
            'listKota' => $this->transaksiModel->get_listOngkir(),
            'keranjang' => $this->keranjangModel->getKeranjang(),
            'ongkir' => $this->ongkirModel->getOngkir(),
            'validation' => \Config\Services::validation()
        ];
        //bingung ka
        
        $produk = $this->request->getVar('id_produk');
        $qty = $this->request->getVar('qty');
        $total_harga = $this->request->getVar('total_harga');

        $biaya_ongkir = $this->transaksiModel->where(['id_ongkirFK => id_ongkir'])

        // cek keranjang user, apakah ada atau tidak
        $cek_keranjang = $this->keranjangModel->where(['id_userFK' => user_id(), 'id_produkFK' => $produk]);
        // ambil qty yang ada ditable keranjang punyanya user, terus tambahkan dengan qty yang diinputkan
        $row = $cek_keranjang->first();
        $total_qty = $qty + $row['qty'];

        return view('transaksi/index', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([

            //untuk menampilkan bahasa error yang kita inginkan
            'id_ongkirFK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
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
            ],
            'total_tagihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('/transaksi'))->withInput();
        } else {
            //untuk savenya
            $this->transaksiModel->save([
                'id_ongkirFK' => $this->request->getVar('id_ongkirFK'),
                'nama' => $this->request->getVar('nama'),
                'telp' => $this->request->getVar('telp'),
                'alamat' => $this->request->getVar('alamat'),
                'total_tagihan' => $this->request->getVar('total_tagihan')
            ]);
            session()->setFlashdata('pesan', 'Data Membuat Pesanan, Silahkan Bayar Sesuai Nominal dan Sertakan Bukti Pembayaran');
            return redirect()->to(base_url('/keranjang'));
        }
    }
}
