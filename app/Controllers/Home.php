<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        //return view('pages/home');
        $data = [
            'title' => 'Home|MJ Sport Collection',
            'produk' => $this->produkModel->getProdukAdmin(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        //echo view('Layout/header', $data);
        return view('home/index', $data);
        //echo view('Layout/footer');
    }
    public function detail($slug_produk)
    {
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProdukAdmin($slug_produk)
        ];
        return view('home/detail', $data);
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

        return view('home/index', $data);
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

        return view('home/index', $data);
    }
}
