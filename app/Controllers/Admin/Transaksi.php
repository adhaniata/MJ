<?php

namespace App\Controllers\Admin;

use App\Models\{TransaksiModel, TransaksiDetailModel, KonfirmasiModel};
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
        $this->konfirmasiModel = new KonfirmasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->findAll(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];
        return view('admin/transaksi/index', $data);
    }

    public function tampilanBelumBayar()
    {
        $data = [
            'title' => 'Transaksi Belum Di Bayar |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('status_pembayaran', 'MENUNGGU PEMBAYARAN')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];

        return view('admin/transaksi/belumbayar', $data);
    }

    public function tampilanBatal()
    {
        $data = [
            'title' => 'Transaksi Batal |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('status_pengiriman', 'Batal')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];

        return view('admin/transaksi/batal', $data);
    }

    public function tampilanProses()
    {
        $data = [
            'title' => 'Transaksi Sedang Di Proses |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('validasi', 'VALID')->where('status_pengiriman', 'PROSES PENGIRIMAN')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];

        return view('admin/transaksi/proses', $data);
    }
    public function tampilanSelesai()
    {
        $data = [
            'title' => 'Transaksi Selesai |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('status_pengiriman', 'DITERIMA')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];

        return view('admin/transaksi/selesai', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('admin/transaksi/detail', $data);
    }
    public function edit($id)
    {
        helper('form');
        $data = [
            'title' => 'Form Edit Data Transaksi',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id)
        ];
        return view('admin/transaksi/edit', $data);
    }
    public function update($id)
    {
        helper('form');
        //cek no_resi untuk update (berguna untuk menghindari rules required dan is unique)
        $resiLama = $this->transaksiModel->find($id);
        if ($resiLama['no_resi'] == $this->request->getVar('no_resi')) {
            $rule_resi = 'required';
        } else {
            $rule_resi = 'required|is_unique[transaksi.no_resi]';
        }
        //validasi input
        if (!$this->validate([
            //kalau menggunakan ini akan banyak error maka akan dikondisikan
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            'status_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'no_resi' => [
                'rules' => $rule_resi,
                'errors' => [
                    'required' => '{field} no resi sudah ada.'
                ]
            ],
            'status_pengiriman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/transaksi/edit/' . $this->request->getVar('$id')))->withInput();
        } else {
            //method savenya
            $this->transaksiModel->save([
                'id_transaksi' => $id,
                'status_pembayaran' => $this->request->getVar('status_pembayaran'),
                'no_resi' => $this->request->getVar('no_resi'),
                'status_pengiriman' => $this->request->getVar('status_pengiriman')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/admin/transaksi'));
        }
    }
    public function delete($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        $this->transaksiModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to(base_url('/admin/transaksi'));
    }
    public function konfirmasi($id)
    {
        helper('form');
        $data = [
            'title' => 'Konfirmasi',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id)
        ];
        return view('admin/transaksi/konfirmasi', $data);
    }
    public function updateKonfirmasi()
    {
        $id_transaksi = $this->request->getVar('id_transaksi');
        //validasi input
        if (!$this->validate([
            'validasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/transaksi/konfirmasi/' . $id_transaksi))->withInput();
        } else {
            //method savenya
            $this->transaksiModel->update($id_transaksi, [
                'validasi' => $this->request->getVar('validasi')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');
            return redirect()->to(base_url('/admin/transaksi'));
        }
    }
    public function cetakdetail($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        $html = view('admin/transaksi/export-pdf-detail', $data);
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Detail Pembelian", array("Attachment" => false));
    }
    public function proses()
    {
        $filter = $this->request->getVar('filter');
        $tanggal = $this->request->getVar('tanggal');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $type = $this->request->getVar('type');

        // cek filter
        if ($filter != '') {
            if ($filter == 'tgl') {
                $transaksi = $this->transaksiModel->where('DATE(created_at)', $tanggal)->get()->getResultArray();
                $ket = 'Laporan Transaksi Penjualan MJ Sport Tanggal ' . $tanggal;
            } else if ($filter == 'bln') {
                $transaksi = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bulan)), 'YEAR(created_at)', date('Y', strtotime($bulan)))->get()->getResultArray();
                $ket = 'Laporan Transaksi Penjualan MJ Sport Bulan ' . $bulan;
            } else {
                $transaksi = $this->transaksiModel->where('YEAR(created_at)', date('Y', strtotime($tahun)))->get()->getResultArray();
                $ket = 'Laporan Transaksi Penjualan MJ Sport Tahun ' . $tahun;
            }
        } else {
            $transaksi = $this->transaksiModel->findAll();
            $ket = 'Laporan Semua Transaksi Penjualan MJ Sport';
        }

        // cek type cetak
        if ($type == 'pdf') {
            $data = [
                'title' => 'Daftar Transaksi |MJ Sport Collection',
                'transaksi' => $transaksi,
                'count' => $this->transaksiModel->countAllResults(),
                'ket' => $ket
            ];

            $html = view('admin/transaksi/export-pdf', $data);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream("Laporan Penjualan MJ Sport", array("Attachment" => false));
        } else {
            $spreadsheet = new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', $ket)
                ->mergeCells('A1:I1')
                ->setCellValue('A3', 'No')
                ->setCellValue('B3', 'ID Transaksi')
                ->setCellValue('C3', 'Nama')
                ->setCellValue('D3', 'Total Tagihan')
                ->setCellValue('E3', 'Status Pembayaran')
                ->setCellValue('F3', 'No Resi')
                ->setCellValue('G3', 'Status Pengiriman')
                ->setCellValue('H3', 'Tanggal Transaksi');

            $column = 4;

            $i = 1;
            foreach ($transaksi as $t) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $i++)
                    ->setCellValue('B' . $column, $t['id_transaksi'])
                    ->setCellValue('C' . $column, $t['nama'])
                    ->setCellValue('D' . $column, $t['total_tagihan'])
                    ->setCellValue('E' . $column, $t['status_pembayaran'])
                    ->setCellValue('F' . $column, $t['no_resi'])
                    ->setCellValue('G' . $column, $t['status_pengiriman'])
                    ->setCellValue('H' . $column, $t['created_at']);

                $column++;
            }

            $writer = new Xlsx($spreadsheet);
            $filename = 'Laporan Penjualan MJ Sport';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }
    public function cari()
    {
        $cari = $this->request->getVar('cari');

        $data = [
            'title' => 'Hasil Pencarian |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->like('nama', $cari)->get()->getResultArray(),
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];

        return view('admin/transaksi/index', $data);
    }
    public function fillter_tp()
    {
        // coba fillter

        $filter_tp = $this->request->getVar('filter_tp');
        $tanggal_tp = $this->request->getVar('tanggal_tp');
        $bulan_tp = $this->request->getVar('bulan_tp');
        $tahun_tp = $this->request->getVar('tahun_tp');


        // cek filter
        if ($filter_tp != '') {
            if ($filter_tp == 'tgl_tp') {
                $transaksi_tp = $this->transaksiModel->where('DATE(created_at)', $tanggal_tp)->get()->getResultArray();
            } else if ($filter_tp == 'bln_tp') {
                $transaksi_tp = $this->transaksiModel->where('MONTH(created_at)', date('m', strtotime($bulan_tp)), 'YEAR(created_at)', date('Y', strtotime($bulan_tp)))->get()->getResultArray();
            } else {
                $transaksi_tp = $this->transaksiModel->where('YEAR(created_at)', date('Y', strtotime($tahun_tp)))->get()->getResultArray();
            }
        } else {
            $transaksi_tp = $this->transaksiModel->findAll();
        }

        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            // 'transaksi' => $this->transaksiModel->findAll(),
            'transaksi' => $transaksi_tp,
            'count' => $this->transaksiModel->countAllResults(),
            'tahun' => $this->transaksiModel->select('YEAR(created_at) as tahun')->groupBy('tahun')->get()->getResultArray()
        ];
        // return view('admin/transaksi/index', $data);

        return view('admin/transaksi/index', $data);
    }
}
