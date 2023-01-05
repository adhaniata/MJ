<?php

namespace App\Controllers;

use App\Models\{KeranjangModel, ProdukModel, OngkirModel};

class Keranjang extends BaseController
{
    protected $KeranjangModel;
    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->ongkirModel = new OngkirModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Keranjang |MJ Sport Collection',
            'keranjang' => $this->keranjangModel->getKeranjang(),
            'count' => $this->keranjangModel->where('id_userFK',user_id())->countAllResults()
        ];
        return view('keranjang/index', $data);
    }

    public function tambahKeranjang()
    {
        $produk = $this->request->getVar('id_produk');
        $qty = $this->request->getVar('qty');
        $total_harga = $this->request->getVar('total_harga');

        // cek keranjang user, apakah ada atau tidak
        $cek_keranjang = $this->keranjangModel->where(['id_userFK' => user_id(), 'id_produkFK' => $produk]);

        // cek stok produk yang tersedia
        $cek_stok = $this->produkModel->where('id_produk', $produk)->first();

        // jika keranjang masih kosong
        if ($cek_keranjang->countAllResults() == 0) {
            // kondisi jika qty yang diinput kecil dari stok produk yang tersedia
            if ($qty <= $cek_stok['stok']) {
                // insert ke table keranjang
                $this->keranjangModel->save([
                    'id_userFK' => user_id(),
                    'id_produkFK' => $produk,
                    'qty' => $qty,
                    'total_harga' => $total_harga,
                    'subtotal_harga' => $total_harga * $qty
                ]);
                return redirect()->to(base_url('/keranjang'));
            } else {
                session()->setFlashdata('pesan', 'Stok produk kurang');
                return redirect()->to(base_url('/produk/' . $cek_stok['slug_produk']));
            }
        } else {
            // ambil qty yang ada ditable keranjang punyanya user, terus tambahkan dengan qty yang diinputkan
            $row = $cek_keranjang->first();
            $total_qty = $qty + $row['qty'];

            // kondisi jika jumlah qty kecil data jumlah stok yang tersedia
            if ($total_qty <= $cek_stok['stok']) {
                // update qty yang ada dikeranjang punya user
                $this->keranjangModel->update($row['id_keranjang'], [
                    'qty' => $total_qty,
                    'subtotal_harga' => $total_harga * $total_qty
                ]);
                return redirect()->to(base_url('/keranjang'));
            } else {
                session()->setFlashdata('pesan', 'Stok produk kurang');
                return redirect()->to(base_url('/produk/' . $cek_stok['slug_produk']));
            }
        }
    }

    public function update($id_keranjang)
    {   
        // inputan qty
        $qty = $this->request->getVar('qty');
        $total_harga = $this->request->getVar('total_harga');

        //  data dari keranjang
        $keranjang = $this->keranjangModel->find($id_keranjang);

        // ambil data produk berdasarkan id keranjang
        $produk = $this->produkModel->find($keranjang['id_produkFK']);

        // cek stok produk
        // kondisi jika qty yang diinput kecil dari stok produk yang tersedia
        if ($qty <= $produk['stok']) {
            $this->keranjangModel->update($keranjang['id_keranjang'], [
                    'qty' => $qty,
                    'subtotal_harga' => $total_harga * $qty
                ]);
        } else {
            session()->setFlashdata('pesan', 'Stok produk kurang');
        }
        return redirect()->to(base_url('/keranjang'));
    }

    public function delete($id_keranjang){
        $this->keranjangModel->delete($id_keranjang);
        return redirect()->to(base_url('/keranjang'));
    }

    public function checkout(){
        $data = [
            'title' => 'Keranjang |MJ Sport Collection',
            'keranjang' => $this->keranjangModel->where('id_userFK',user_id())->join('produk', 'produk.id_produk = keranjang.id_produkFK')->get()->getResultArray(),
            'count' => $this->keranjangModel->where('id_userFK',user_id())->countAllResults(),
            'ongkir' => $this->ongkirModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('keranjang/checkout', $data);
    }
}
