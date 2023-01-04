<?php

namespace App\Controllers;

use App\Models\{KeranjangModel, ProdukModel};

class Keranjang extends BaseController
{
    protected $KeranjangModel;
    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
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
    public function hapusBarang($id_keranjang)
    {
        //$this->keranjangModel->find($id_keranjang);
        $this->keranjangModel->delete($id_keranjang);
        session()->setFlashdata('pesan', 'Keranjang Berhasil di Hapus');
        return redirect()->to(base_url('/keranjang'));
    }
}
