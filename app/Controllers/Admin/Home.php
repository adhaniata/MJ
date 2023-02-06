<?php

namespace App\Controllers\Admin;

use App\Models\{ProdukModel, KategoriModel, TransaksiModel, OngkirModel, PengembalianModel};
use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        //var_dump(in_groups('user')); die();

        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->transaksiModel = new TransaksiModel();
        $this->ongkirModel = new OngkirModel();
        $this->pengembalianModel = new PengembalianModel();
    }

    //untuk index
    public function index()
    {
        $bulan = $this->transaksiModel->select('created_at as bulan')->orderBy('created_at ASC')->groupBy('MONTH(created_at)')->get()->getResultArray();

        foreach ($bulan as $b) {
            $namaBulan[] = date('F', strtotime($b['bulan']));
            $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
            $pendapatan_chart[] = $pendapatan[0]['pendapatan'];
            $transaksi_chart[] = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->countAllResults();
            $pengembalian_chart[] = $this->pengembalianModel->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->countAllResults();
        }

        $data = [
            'title' => 'Home|MJ Sport Collection',
            'produk' => $this->produkModel->getProduk(),
            'listKategori' => $this->produkModel->get_listKategori(),
            'produks' => $this->produkModel->findAll(),
            'kategori' => $this->kategoriModel->findAll(),
            'transaksi' => $this->transaksiModel->findAll(),
            'ongkir' => $this->ongkirModel->findAll(),
            'pengembalian' => $this->pengembalianModel->findAll(),
            'countProduk' => $this->produkModel->countAllResults(),
            'countKategori' => $this->kategoriModel->countAllResults(),
            'countTransaksi' => $this->transaksiModel->countAllResults(),
            'countOngkir' => $this->ongkirModel->countAllResults(),
            'countPengembalian' => $this->pengembalianModel->where('validasi', 'Valid')->countAllResults(),
            //'countProdukByKat' => $this->produkModel->getCountProdukByKategori()->getResultArray(),
            //'kategori' => $this->kategoriModel->get()->getResultArray(),
            'count' => $this->transaksiModel->countAllResults(),
            'namaBulan' => $namaBulan,
            'pendapatan' => $pendapatan_chart,
            'transaksi_chart' => $transaksi_chart,
            'pengembalian_chart' => $pengembalian_chart,
        ];

        return view('admin/home/index', $data);
    }
    public function detail($slug_admin)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProduk($slug_admin)
        ];

        return view('admin/home/detail', $data);
    }
}
