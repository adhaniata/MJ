<?php

namespace App\Controllers\Admin;

use App\Models\{TransaksiModel, TransaksiDetailModel, KonfirmasiModel};
use App\Controllers\BaseController;
use Dompdf\Dompdf;

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
            'count' => $this->transaksiModel->countAllResults()
        ];
        return view('admin/transaksi/index', $data);
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
                'rules' => 'is_unique[transaksi.no_resi]',
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
            'transaksi' => $this->konfirmasiModel->find($id)
        ];
        return view('admin/transaksi/konfirmasi', $data);
    }
    public function updateKonfirmasi($id)
    {
        helper('form');
        $data = [
            'title' => 'Form Konfirmasi Pembayaran',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id),
            'konfirmasi' => $this->konfirmasiModel->find($id)
        ];
        return view('admin/transaksi/konfirmasi', $data);
        //validasi input
        if (!$this->validate([
            'validasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/transaksi/konfirmasi/' . $this->request->getVar('$id')))->withInput();
        } else {
            //method savenya
            $this->konfirmasiModel->save([
                'id_konfirmasi' => $id,
                'validasi' => $this->request->getVar('validasi')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');
            return redirect()->to(base_url('/admin/transaksi'));
        }
    }
    public function printall()
    {
        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->findAll(),
            'count' => $this->transaksiModel->countAllResults()
        ];
        return view('admin/transaksi/printall', $data);
    }
    public function printdetail($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];
        return view('admin/transaksi/printdetail', $data);
    }
    public function exportPDF()
    {
        $data = [
            'title' => 'Daftar Transaksi |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->findAll(),
            'count' => $this->transaksiModel->countAllResults()
        ];

        $view = view('admin/transaksi/export-pdf', $data);

        //untuk dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Penjualan MJ Sport", array("Attachment" => false));
    }
    public function exportExcel()
    {
    }
}
