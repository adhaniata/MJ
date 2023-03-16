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
        $judulPendapatan = '';
        $judulTransaksi = '';
        $judulPengembalian = '';
        $type_chart_pendapatan='bar';
        $type_chart_transaksi='bar';
        $type_chart_pengembalian='bar';

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
                // tipe chart untuk ditampilkan (bar/line)
                $type_chart_pendapatan = 'bar';
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanPendapatan[] = date('d F, Y', strtotime($tanggal));
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada tanggal ' . $tanggal;

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
                $type_chart_pendapatan = 'bar';
                $bulan = $this->request->getVar('bulan');
                $namaBulanPendapatan[] = date('F, Y', strtotime($bulan));
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada Bulan ' . $bulan;

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
            } else if ($filter == 'periode_tanggal') {
                $type_chart_pendapatan = 'line';
                // periode tahun
                $tanggal_p1 = $this->request->getVar('tanggal_periode1');
                $tanggal_p2 = $this->request->getVar('tanggal_periode2');
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada tanggal ' . $tanggal_p1 . 'sampai tanggal ' . $tanggal_p2;

                // $ambiltgl = $this->transaksiDetailModel->select('DATE(transaksi_detail.created_at) as tanggal, transaksi.status_pengiriman as status ')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('DATE(transaksi_detail.created_at) >=', $tanggal_p1)
                //     ->where('DATE(transaksi_detail.created_at) <=', $tanggal_p2)
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->groupBy('DATE(transaksi_detail.created_at)')
                //     ->get()->getResultArray();
                // foreach ($ambiltgl as $key => $value) {
                //     $namaBulanPendapatan[] = date('d F, Y', strtotime($value['tanggal']));
                // }

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran, DATE(transaksi_detail.created_at) as tanggal, transaksi.status_pengiriman as status')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('DATE(transaksi_detail.created_at) >=', $tanggal_p1)
                    ->where('DATE(transaksi_detail.created_at) <=', $tanggal_p2)
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->groupBy('DATE(transaksi_detail.created_at)')
                    ->get();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                // $pendapatan_chart[] = $produk['pendapatan'];
                // $pengeluaran_chart[] = $produk['pengeluaran'];

                if ($produk->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $produk->getResultArray();

                    foreach ($data as $key => $value) {
                        $pendapatan_chart[] = $value['pendapatan'];
                        $pengeluaran_chart[] = $value['pengeluaran'];
                        $namaBulanPendapatan[] = date('d F, Y', strtotime($value['tanggal']));
                    }
                } else {
                    $pendapatan_chart = 0;
                    $pengeluaran_chart = 0;
                    $namaBulanPendapatan = [$tanggal_p1, $tanggal_p1];
                    $judulPendapatan = 'Pendapatan dan Pengeluaran pada tanggal ' . $tanggal_p1 . ' sampai tanggal ' . $tanggal_p2 . ' Kosong';
                }


                // foreach ($produk as $key => $value) {
                //     $pendapatan_chart[] = $value['pendapatan'];
                //     $pengeluaran_chart[] = $value['pengeluaran'];
                //     $namaBulanPendapatan[] = date('d F, Y', strtotime($value['tanggal']));
                // }
            } else if ($filter == 'periode_bulan') {
                $type_chart_pendapatan = 'line';
                // periode tahun
                $bulan_p1 = $this->request->getVar('bulan_periode1');
                $bulan_p2 = $this->request->getVar('bulan_periode2');
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada bulan ' . $bulan_p1 . 'sampai tanggal ' . $bulan_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                // $ambilbl = $this->transaksiDetailModel->select('DATE(transaksi_detail.created_at) as bulans, transaksi.status_pengiriman as status ')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('MONTH(transaksi_detail.created_at) >=', date('m', strtotime($bulan_p1)))
                //     ->where('YEAR(transaksi_detail.created_at) >=', date('Y', strtotime($bulan_p1)))
                //     ->where('MONTH(transaksi_detail.created_at) <=', date('m', strtotime($bulan_p2)))
                //     ->where('YEAR(transaksi_detail.created_at) <=', date('Y', strtotime($bulan_p2)))
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->groupBy('MONTH(transaksi_detail.created_at)')
                //     ->get()->getResultArray();

                // foreach ($ambilbl as $key => $value) {
                //     $namaBulanPendapatan[] = date('F, Y', strtotime($value['bulans']));
                // }

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran, DATE(transaksi_detail.created_at) as bulans, transaksi.status_pengiriman as status')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('MONTH(transaksi_detail.created_at) >=', date('m', strtotime($bulan_p1)))
                    ->where('YEAR(transaksi_detail.created_at) >=', date('Y', strtotime($bulan_p1)))
                    ->where('MONTH(transaksi_detail.created_at) <=', date('m', strtotime($bulan_p2)))
                    ->where('YEAR(transaksi_detail.created_at) <=', date('Y', strtotime($bulan_p2)))
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->groupBy('MONTH(transaksi_detail.created_at)')
                    ->get();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                // $pendapatan_chart[] = $produk['pendapatan'];
                // $pengeluaran_chart[] = $produk['pengeluaran'];

                if ($produk->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $produk->getResultArray();

                    foreach ($data as $key => $value) {
                        $pendapatan_chart[] = $value['pendapatan'];
                        $pengeluaran_chart[] = $value['pengeluaran'];
                        $namaBulanPendapatan[] = date('F, Y', strtotime($value['bulans']));
                    }
                } else {
                    $pendapatan_chart = 0;
                    $pengeluaran_chart = 0;
                    $namaBulanPendapatan = [$bulan_p1, $bulan_p2];
                    $judulPendapatan = 'Pendapatan dan Pengeluaran pada bulan ' . $bulan_p1 . ' sampai bulan ' . $bulan_p2 . ' Kosong';
                }

                // foreach ($produk as $key => $value) {
                //     $pendapatan_chart[] = $value['pendapatan'];
                //     $pengeluaran_chart[] = $value['pengeluaran'];
                //     $namaBulanPendapatan[] = date('F, Y', strtotime($value['bulans']));
                // }
            } else if ($filter == 'periode_tahun') {
                $type_chart_pendapatan = 'line';
                // periode tahun
                $tahun_p1 = $this->request->getVar('tahun_periode1');
                $tahun_p2 = $this->request->getVar('tahun_periode2');
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada tahun ' . $tahun_p1 . 'sampai tahun ' . $tahun_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                // $ambilth = $this->transaksiDetailModel->select('YEAR(transaksi_detail.created_at) as tahun, transaksi.status_pengiriman as status')
                //     ->where('transaksi.status_pengiriman', 'DITERIMA')
                //     ->where('YEAR(transaksi_detail.created_at) >=', $tahun_p1)
                //     ->where('YEAR(transaksi_detail.created_at) <=', $tahun_p2)
                //     ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                //     ->groupBy('YEAR(transaksi_detail.created_at)')
                //     ->get()->getResultArray();
                // foreach ($ambilth as $key => $value) {
                //     $namaBulanPendapatan[] = $value['tahun'];
                // }
                // $namaBulanPendapatan[] = $ambilth['tahun'];

                $produk = $this->transaksiDetailModel->select('(SUM((transaksi_detail.total_harga) * transaksi_detail.qty)) as pendapatan, (SUM(produk.modal_produk * transaksi_detail.qty)) as pengeluaran, YEAR(transaksi_detail.created_at) as tahun, transaksi.status_pengiriman as status')
                    ->where('transaksi.status_pengiriman', 'DITERIMA')
                    ->where('YEAR(transaksi_detail.created_at) >=', $tahun_p1)
                    ->where('YEAR(transaksi_detail.created_at) <=', $tahun_p2)
                    ->join('transaksi', 'transaksi.id_transaksi = transaksi_detail.id_transaksiFK', 'left')
                    ->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK', 'left')
                    ->groupBy('YEAR(transaksi_detail.created_at)')
                    ->get();
                // $pendapatan = $this->transaksiModel->select('SUM(total_tagihan) as pendapatan')->where('status_pengiriman', 'DITERIMA')->where('MONTH(created_at)', date('m', strtotime($b['bulan'])))->get()->getResultArray();
                // $pendapatan_chart[] = $produk['pendapatan'];
                // $pengeluaran_chart[] = $produk['pengeluaran'];

                if ($produk->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $produk->getResultArray();

                    foreach ($data as $key => $value) {
                        $pendapatan_chart[] = $value['pendapatan'];
                        $pengeluaran_chart[] = $value['pengeluaran'];
                        $namaBulanPendapatan[] = $value['tahun'];
                    }
                } else {
                    $pendapatan_chart = 0;
                    $pengeluaran_chart = 0;
                    $namaBulanPendapatan = range($tahun_p1, $tahun_p2);
                    $judulPendapatan = 'Pendapatan dan Pengeluaran pada tahun ' . $tahun_p1 . ' sampai tahun ' . $tahun_p2 . ' Kosong';
                }
                // foreach ($produk as $key => $value) {
                //     $pendapatan_chart[] = $value['pendapatan'];
                //     $pengeluaran_chart[] = $value['pengeluaran'];
                //     $namaBulanPendapatan[] = $value['tahun'];
                // }
            } else {
                $type_chart_pendapatan = 'bar';
                $tahun = $this->request->getVar('tahun');
                $namaBulanPendapatan[] = $tahun;
                $judulPendapatan = 'Pendapatan dan Pengeluaran pada tahun ' . $tahun;

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

            // bulan untuk pengembalian
            foreach ($bulan_pengembalian as $bln_pengembalian) {
                $namaBulanPengembalian[] = date('F', strtotime($bln_pengembalian['bulan']));
                $pengembalian_chart[] = $this->pengembalianModel->where('MONTH(created_at)', date('m', strtotime($bln_pengembalian['bulan'])))->countAllResults();
            }

            // chart transaksi
            if ($filter == 'tanggal') {
                $type_chart_transaksi = 'bar';
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanTransaksi[] = date('F', strtotime($tanggal));
                $judulTransaksi = 'Transaksi pada tanggal ' . $tanggal;

                $transaksi_chart[] = $this->transaksiModel
                    ->where('validasi', 'VALID')
                    ->where('DATE(created_at)', $tanggal)
                    ->countAllResults();
            } else if ($filter == 'bulan') {
                $type_chart_transaksi = 'bar';
                $bulan = $this->request->getVar('bulan');
                $namaBulanTransaksi[] = date('F, Y', strtotime($bulan));
                $judulTransaksi = 'Transaksi pada bulan ' . $bulan;

                $transaksi_chart[] = $this->transaksiModel
                    ->where('validasi', 'VALID')
                    ->where('MONTH(created_at)', date('m', strtotime($bulan)))
                    ->where('YEAR(created_at)', date('Y', strtotime($bulan)))
                    ->countAllResults();
                // fillter range transaksi
            } else if ($filter == 'periode_tanggal') {
                $type_chart_transaksi = 'line';
                // periode tahun
                $tanggal_p1 = $this->request->getVar('tanggal_periode1');
                $tanggal_p2 = $this->request->getVar('tanggal_periode2');
                $judulTransaksi = 'Transaksi pada tanggal ' . $tanggal_p1 . 'sampai tanggal ' . $tanggal_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                $ambiltgl = $this->transaksiModel->select('DATE(created_at) as tanggal, COUNT(DATE(created_at)) as jumlah')
                    ->where('validasi', 'VALID')
                    ->where('DATE(created_at) >=', $tanggal_p1)
                    ->where('DATE(created_at) <=', $tanggal_p2)
                    ->groupBy('DATE(created_at)')
                    ->get();

                // foreach ($ambiltgl as $key => $value) {
                //     $namaBulanTransaksi[] = date('d F, Y', strtotime($value['tanggal']));
                //     $transaksi_chart[] = $value['jumlah'];
                // }
                if ($ambiltgl->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambiltgl->getResultArray();

                    foreach ($data as $key => $value) {
                        $namaBulanTransaksi[] = date('d F, Y', strtotime($value['tanggal']));
                        $transaksi_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulTransaksi = 'Transaksi pada tanggal ' . $tanggal_p1 . ' sampai tanggal ' . $tanggal_p2 . ' Kosong';
                    $namaBulanTransaksi = [$tanggal_p1, $tanggal_p2];
                    $transaksi_chart = 0;
                }

                // $this->db->select('user_id, COUNT(user_id) as total');
                // $this->db->group_by('user_id'); 
                // $this->db->order_by('total', 'desc'); 
                // $this->db->get('tablename', 10);
            } else if ($filter == 'periode_bulan') {
                $type_chart_transaksi = 'line';
                // periode tahun
                $bulan_p1 = $this->request->getVar('bulan_periode1');
                $bulan_p2 = $this->request->getVar('bulan_periode2');
                $judulTransaksi = 'Transaksi pada bulan ' . $bulan_p1 . 'sampai bulan ' . $bulan_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                $ambilbl = $this->transaksiModel->select('DATE(created_at) as bulans, COUNT(MONTH(created_at)) as jumlah')
                    ->where('validasi', 'VALID')
                    ->where('MONTH(created_at) >=', date('m', strtotime($bulan_p1)))
                    ->where('YEAR(created_at) >=', date('Y', strtotime($bulan_p1)))
                    ->where('MONTH(created_at) <=', date('m', strtotime($bulan_p2)))
                    ->where('YEAR(created_at) <=', date('Y', strtotime($bulan_p2)))
                    ->groupBy('MONTH(created_at)')
                    ->get();

                // foreach ($ambilbl as $key => $value) {
                //     $namaBulanTransaksi[] = date('F, Y', strtotime($value['bulans']));
                //     $transaksi_chart[] = $value['jumlah'];
                // }

                if ($ambilbl->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambilbl->getResultArray();

                    foreach ($data as $key => $value) {
                        $namaBulanTransaksi[] = date('F, Y', strtotime($value['bulans']));
                        $transaksi_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulTransaksi = 'Transaksi pada bulan ' . $bulan_p1 . ' sampai bulan ' . $bulan_p2 . ' Kosong';
                    $namaBulanTransaksi = [$bulan_p1, $bulan_p2];
                    $transaksi_chart = 0;
                }
            } else if ($filter == 'periode_tahun') {
                $type_chart_transaksi = 'line';
                // periode tahun
                $tahun_p1 = $this->request->getVar('tahun_periode1');
                $tahun_p2 = $this->request->getVar('tahun_periode2');
                $judulTransaksi = 'Transaksi pada tahun ' . $tahun_p1 . 'sampai tahun ' . $tahun_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                $ambilth = $this->transaksiModel->select('YEAR(created_at) as tahun, COUNT(YEAR(created_at)) as jumlah')
                    ->where('validasi', 'VALID')
                    ->where('YEAR(created_at) >=', $tahun_p1)
                    ->where('YEAR(created_at) <=', $tahun_p2)
                    ->groupBy('YEAR(created_at)')
                    ->get();

                // foreach ($ambilth as $key => $value) {
                //     $namaBulanTransaksi[] = $value['tahun'];
                //     $transaksi_chart[] = $value['jumlah'];
                // }

                if ($ambilth->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambilth->getResultArray();

                    foreach ($data as $key => $value) {
                        $namaBulanTransaksi[] = $value['tahun'];
                        $transaksi_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulTransaksi = 'Transaksi pada tahun ' . $tahun_p1 . ' sampai tahun ' . $tahun_p2 . ' Kosong';
                    $namaBulanTransaksi = range($tahun_p1, $tahun_p2);
                    $transaksi_chart = 0;
                }
            } else {
                $type_chart_transaksi = 'bar';
                $tahun = $this->request->getVar('tahun');
                $namaBulanTransaksi[] = date('Y', strtotime($tahun));
                $judulTransaksi = 'Transaksi pada tahun ' . $tahun;

                $transaksi_chart[] = $this->transaksiModel
                    ->where('validasi', 'VALID')
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

            // bulan untuk jumlah pengembalian
            foreach ($bulan as $bln_trans) {
                $namaBulanTransaksi[] = date('F', strtotime($bln_trans['bulan']));
                $transaksi_chart[] = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bln_trans['bulan'])))->countAllResults();
            }

            if ($filter == 'tanggal') {
                $type_chart_pengembalian = 'bar';
                $tanggal = $this->request->getVar('tanggal');
                $namaBulanPengembalian[] = date('F', strtotime($tanggal));
                $judulPengembalian = 'Pengembalian pada tanggal ' . $tanggal;

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('validasi', 'Valid')
                    ->where('DATE(created_at)', $tanggal)
                    ->countAllResults();
            } else if ($filter == 'bulan') {
                $type_chart_pengembalian = 'bar';
                $bulan = $this->request->getVar('bulan');
                $namaBulanPengembalian[] = date('F, Y', strtotime($bulan));
                $judulPengembalian  = 'pengembalian pada bulan ' . $bulan;

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('validasi', 'Valid')
                    ->where('MONTH(created_at)', date('m', strtotime($bulan)))
                    ->where('YEAR(created_at)', date('Y', strtotime($bulan)))
                    ->countAllResults();
            } else if ($filter == 'periode_tanggal') {
                $type_chart_pengembalian = 'line';
                // periode tahun
                $tanggal_p1 = $this->request->getVar('tanggal_periode1');
                $tanggal_p2 = $this->request->getVar('tanggal_periode2');
                $judulPengembalian = 'Pengembalian pada tanggal ' . $tanggal_p1 . 'sampai tanggal ' . $tanggal_p2;
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);

                $ambiltgl = $this->pengembalianModel->select('DATE(created_at) as tanggal, COUNT(DATE(created_at)) as jumlah')
                    ->where('validasi', 'Valid')
                    ->where('DATE(created_at) >=', $tanggal_p1)
                    ->where('DATE(created_at) <=', $tanggal_p2)
                    ->groupBy('DATE(created_at)')
                    ->get();

                if ($ambiltgl->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambiltgl->getResultArray();
                    foreach ($data as $key => $value) {
                        $namaBulanPengembalian[] = date('d F, Y', strtotime($value['tanggal']));
                        $pengembalian_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulPengembalian = 'Pengembalian pada tanggal ' . $tanggal_p1 . ' sampai tanggal ' . $tanggal_p2 . ' Kosong';
                    $namaBulanPengembalian = [$tanggal_p1, $tanggal_p2];
                    $pengembalian_chart = 0;
                }


                // foreach ($ambiltgl as $key => $value) {
                //     $namaBulanPengembalian[] = date('d F, Y', strtotime($value['tanggal']));
                //     $pengembalian_chart[] = $value['jumlah'];
                // }
            } else if ($filter == 'periode_bulan') {
                $type_chart_pengembalian = 'line';
                // periode tahun
                $bulan_p1 = $this->request->getVar('bulan_periode1');
                $bulan_p2 = $this->request->getVar('bulan_periode2');
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);
                $judulPengembalian  = 'Pengembalian pada bulan ' . $bulan_p1 . 'sampai bulan ' . $bulan_p2;

                $ambilbl = $this->pengembalianModel->select('DATE(created_at) as bulans, COUNT(MONTH(created_at)) as jumlah')
                    ->where('validasi', 'Valid')
                    ->where('MONTH(created_at) >=', date('m', strtotime($bulan_p1)))
                    ->where('YEAR(created_at) >=', date('Y', strtotime($bulan_p1)))
                    ->where('MONTH(created_at) <=', date('m', strtotime($bulan_p2)))
                    ->where('YEAR(created_at) <=', date('Y', strtotime($bulan_p2)))
                    ->groupBy('MONTH(created_at)')
                    ->get();

                if ($ambilbl->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambilbl->getResultArray();
                    foreach ($data as $key => $value) {
                        $namaBulanPengembalian[] = date('F, Y', strtotime($value['bulans']));
                        $pengembalian_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulPengembalian = 'Pengembalian pada bulan ' . $bulan_p1 . ' sampai bulan ' . $bulan_p2 . ' Kosong';
                    $namaBulanPengembalian = [$bulan_p1, $bulan_p2];
                    $pengembalian_chart = 0;
                }
            } else if ($filter == 'periode_tahun') {
                $type_chart_pengembalian = 'line';
                // periode tahun
                $tahun_p1 = $this->request->getVar('tahun_periode1');
                $tahun_p2 = $this->request->getVar('tahun_periode2');
                // $namaBulanPendapatan = range($tahun_p1, $tahun_p2);
                $judulPengembalian  = 'Pengembalian pada tahun ' . $tahun_p1 . 'sampai tahun ' . $tahun_p2;

                $ambilth = $this->pengembalianModel->select('YEAR(created_at) as tahun, COUNT(YEAR(created_at)) as jumlah')
                    ->where('validasi', 'Valid')
                    ->where('YEAR(created_at) >=', $tahun_p1)
                    ->where('YEAR(created_at) <=', $tahun_p2)
                    ->groupBy('YEAR(created_at)')
                    ->get();

                if ($ambilth->getNumRows() > 0) {
                    //hasil query tampung kedalam variable data
                    // $data = $cek_data->getRowArray();
                    $data = $ambilth->getResultArray();
                    foreach ($data as $key => $value) {
                        $namaBulanPengembalian[] = $value['tahun'];
                        $pengembalian_chart[] = $value['jumlah'];
                    }
                } else {
                    $judulPengembalian = 'Pengembalian pada tahun ' . $tahun_p1 . ' sampai tahun ' . $tahun_p2 . ' Kosong';
                    $namaBulanPengembalian = range($tahun_p1, $tahun_p2);
                    $pengembalian_chart = 0;
                }
            } else {
                $type_chart_pengembalian = 'bar';
                $tahun = $this->request->getVar('tahun');
                $namaBulanPengembalian[] = date('Y', strtotime($tahun));
                $judulPengembalian  = 'Pengembalian pada tahun ' . $tahun;

                $pengembalian_chart[] = $this->pengembalianModel
                    ->where('validasi', 'Valid')
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
            'judulPendapatan' => $judulPendapatan,
            'judulTransaksi' => $judulTransaksi,
            'judulPengembalian' => $judulPengembalian,
            'type_chart_pendapatan' => $type_chart_pendapatan,
            'type_chart_transaksi' => $type_chart_transaksi,
            'type_chart_pengembalian' => $type_chart_pengembalian,
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
