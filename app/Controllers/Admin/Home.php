<?php

namespace App\Controllers\Admin;

use App\Models\{ProdukModel, KategoriModel, TransaksiModel, OngkirModel, PengembalianModel, TransaksiDetailModel};
use App\Controllers\BaseController;
use App\Database\Migrations\TransaksiDetail;

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
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    //untuk index
    public function index()
    {
        $bulan = $this->transaksiModel->select('created_at as bulan')->orderBy('created_at ASC')->groupBy('MONTH(created_at)')->get()->getResultArray();

        foreach ($bulan as $b) {
            $namaBulan[] = date('F', strtotime($b['bulan']));
            $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga - produk.modal_produk) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                ->where('transaksi.status_pengiriman', 'DITERIMA')
                ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($b['bulan'])))
                ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                ->get()->getResultArray();
            // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
            $pendapatan_chart[] = $produk[0]['pendapatan'];
            $pengeluaran_chart[] = $produk[0]['pengeluaran'];
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
            'pengeluaran' => $pengeluaran_chart,
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
