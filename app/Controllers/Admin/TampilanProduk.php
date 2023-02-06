<?php

namespace App\Controllers\Admin;

use App\Models\{ProdukModel, TransaksiDetailModel};
use App\Controllers\BaseController;

class TampilanProduk extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tampilan Produk|MJ Sport Collection',
            'produk' => $this->produkModel->getProduk(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];

        return view('admin/tampilanProduk/index', $data);
    }
    public function detail($slug_admin)
    {
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProduk($slug_admin)
        ];

        return view('admin/tampilanProduk/detail', $data);
    }
    public function cari()
    {
        $cari = $this->request->getVar('cari');

        $data = [
            'title' => 'Hasil Pencarian |MJ Sport Collection',
            'produk' => $this->produkModel->like('nama_produk', $cari)->get()->getResultArray(),
            'count' => $this->produkModel->countAllResults(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];

        return view('admin/tampilanProduk/index', $data);
    }
    public function kategori()
    {
        $filter_tp = $this->request->getVar('fillter_tp');

        // cek filter
        if ($filter_tp != '') {
            $produk_tp = $this->produkModel->where('nama_kategori', $filter_tp)->join('kategori', 'kategori.id_kategori = produk.id_kategoriFK')->get()->getResultArray();
        } else {
            $produk_tp = $this->produkModel->findAll();
        }

        $data = [
            'title' => 'Home|MJ Sport Collection',
            'produk' => $produk_tp,
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        // return view('admin/transaksi/index', $data);

        return view('admin/tampilanProduk/index', $data);
    }
}
