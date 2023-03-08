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
        $type = $this->request->getVar('type');

        $bulan = $this->transaksiModel->select('created_at as bulan')->orderBy('created_at ASC')->groupBy('MONTH(created_at)')->get()->getResultArray();
        $bulan_pengembalian = $this->pengembalianModel->select('created_at as bulan')->orderBy('created_at ASC')->groupBy('MONTH(created_at)')->get()->getResultArray();

        // membuat chart stok produk dari berbagai kategori masih error
        $kategori = $this->produkModel->select('produk.id_kategoriFK as jeniskat')->join('kategori', 'kategori.id_kategori = produk.id_kategoriFK')->orderBy('id_kategoriFK ASC')->groupBy('id_kategoriFK')->get()->getResultArray();
        // var_dump($kategori);
        // die;
        foreach ($kategori as $kat) {
            // $namaKategori[] = $j['nama_kategori'];

            $katProduk = $this->produkModel->select('SUM(stok) as total_stok, kategori.nama_kategori')
                ->where('id_kategoriFK', $kat['jeniskat'])
                ->join('kategori', 'kategori.id_kategori = produk.id_kategoriFK')
                ->get()->getResultArray();

            $total_stok[] = $katProduk[0]['total_stok'];
            $namaKategori[] = $katProduk[0]['nama_kategori'];
        }

        // filter
        $filter = $this->request->getVar('filter');

        if ($type == '' || $type == NULL) {
            // bulan untuk pendapatan dan pengeluaran
            foreach ($bulan as $bln_pen_peng) {
                $namaBulanPendapatan[] = date('F', strtotime($bln_pen_peng['bulan']));
                // ori
                // $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga - produk.modal_produk) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($b['bulan'])))
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                //     ->get()->getResultArray();

                // pendapatannya sudah termasuk balik modal
                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($bln_pen_peng['bulan'])))
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            }

            // bulan untuk transaksi
            foreach ($bulan as $bln_trans) {
                $namaBulanTransaksi[] = date('F', strtotime($bln_trans['bulan']));
                $transaksi_chart[] = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bln_trans['bulan'])))->countAllResults();
            }

            // bulan untuk pengemalian
            foreach ($bulan_pengembalian as $bln_pengembalian) {
                $namaBulanPengembalian[] = date('F', strtotime($bln_pengembalian['bulan']));
                $pengembalian_chart[] = $this->pengembalianModel->where('MONTH(created_at)', date('m', strtotime($bln_pengembalian['bulan'])))->countAllResults();
            }
        } else if ($type == 'pendapatan') {
            // bulan untuk transaksi
            foreach ($bulan as $bln_trans) {
                $namaBulanTransaksi[] = date('F', strtotime($bln_trans['bulan']));
                $transaksi_chart[] = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bln_trans['bulan'])))->countAllResults();
            }

            // bulan untuk pengemalian
            foreach ($bulan_pengembalian as $bln_pengembalian) {
                $namaBulanPengembalian[] = date('F', strtotime($bln_pengembalian['bulan']));
                $pengembalian_chart[] = $this->pengembalianModel->where('MONTH(created_at)', date('m', strtotime($bln_pengembalian['bulan'])))->countAllResults();
            }

            if ($filter == 'tanggal') {
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanPendapatan[] = date('d F, Y', strtotime($tanggal));

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('DATE(transaksi_detail.created_at)', $tanggal)
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            } else if ($filter == 'bulan') {
                $bulan = $this->request->getVar('bulan');
                $namaBulanPendapatan[] = date('F, Y', strtotime($bulan));

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($bulan)))
                    ->where('YEAR(transaksi_detail.created_at)', date('Y', strtotime($bulan)))
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            } else {
                $tahun = $this->request->getVar('tahun');
                $namaBulanPendapatan[] = $tahun;

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('YEAR(transaksi_detail.created_at)', $tahun)
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            }
        } else if ($type == 'transaksi') {
            // bulan untuk pendapatan dan pengeluaran
            foreach ($bulan as $bln_pen_peng) {
                $namaBulanPendapatan[] = date('F', strtotime($bln_pen_peng['bulan']));
                // ori
                // $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga - produk.modal_produk) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($b['bulan'])))
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                //     ->get()->getResultArray();

                // pendapatannya sudah termasuk balik modal
                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($bln_pen_peng['bulan'])))
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            }

            // bulan untuk pengemalian
            foreach ($bulan_pengembalian as $bln_pengembalian) {
                $namaBulanPengembalian[] = date('F', strtotime($bln_pengembalian['bulan']));
                $pengembalian_chart[] = $this->pengembalianModel->where('MONTH(created_at)', date('m', strtotime($bln_pengembalian['bulan'])))->countAllResults();
            }

            if ($filter == 'tanggal') {
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanTransaksi[] = date('F', strtotime($tanggal));

                $transaksi_chart[] = $this->transaksiModel
                    ->where('DATE(created_at)', $tanggal)
                    ->countAllResults();
            } else if ($filter == 'bulan') {
                $bulan = $this->request->getVar('bulan');
                $namaBulanTransaksi[] = date('F, Y', strtotime($bulan));

                $transaksi_chart[] = $this->transaksiModel
                    ->where('MONTH(created_at)', date('m', strtotime($bulan)))
                    ->where('YEAR(created_at)', date('Y', strtotime($bulan)))
                    ->countAllResults();
            } else {
                $tahun = $this->request->getVar('tahun');
                $namaBulanTransaksi[] = date('Y', strtotime($tahun));

                $transaksi_chart[] = $this->transaksiModel
                    ->where('YEAR(created_at)', $tahun)
                    ->countAllResults();
            }
        } else {
            // bulan untuk pendapatan dan pengeluaran
            foreach ($bulan as $bln_pen_peng) {
                $namaBulanPendapatan[] = date('F', strtotime($bln_pen_peng['bulan']));
                // ori
                // $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga - produk.modal_produk) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($b['bulan'])))
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                //     ->get()->getResultArray();

                // pendapatannya sudah termasuk balik modal
                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('MONTH(transaksi_detail.created_at)', date('m', strtotime($bln_pen_peng['bulan'])))
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->get()->getResultArray();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                $pendapatan_chart[] = $produk[0]['pendapatan'];
                $pengeluaran_chart[] = $produk[0]['pengeluaran'];
            }

            // bulan untuk transaksi
            foreach ($bulan as $bln_trans) {
                $namaBulanTransaksi[] = date('F', strtotime($bln_trans['bulan']));
                $transaksi_chart[] = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bln_trans['bulan'])))->countAllResults();
            }

            if ($filter == 'tanggal') {
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanPengembalian[] = date('F', strtotime($tanggal));

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('DATE(created_at)', $tanggal)
                    ->countAllResults();
            } else if ($filter == 'bulan') {
                $bulan = $this->request->getVar('bulan');
                $namaBulanPengembalian[] = date('F, Y', strtotime($bulan));

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('MONTH(created_at)', date('m', strtotime($bulan)))
                    ->where('YEAR(created_at)', date('Y', strtotime($bulan)))
                    ->countAllResults();
            } else {
                $tahun = $this->request->getVar('tahun');
                $namaBulanPengembalian[] = date('Y', strtotime($tahun));

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('YEAR(created_at)', $tahun)
                    ->countAllResults();
            }
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
            'namaBulanPendapatan' => $namaBulanPendapatan,
            'namaBulanTransaksi' => $namaBulanTransaksi,
            'namaBulanPengembalian' => $namaBulanPengembalian,
            'pendapatan' => $pendapatan_chart,
            'pengeluaran' => $pengeluaran_chart,
            'transaksi_chart' => $transaksi_chart,
            'pengembalian_chart' => $pengembalian_chart,
            'stok_chart' => $total_stok,
            'namaKategori' => $namaKategori,
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
