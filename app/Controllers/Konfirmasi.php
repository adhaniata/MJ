<?php

namespace App\Controllers;

//use App\Models\KonfirmasiModel;
use App\Models\{KeranjangModel, ProdukModel, TransaksiModel, OngkirModel, TransaksiDetailModel, KonfirmasiModel};
use CodeIgniter\I18n\Time;

class Konfirmasi extends BaseController
{
    protected $KonfirmasiModel;
    public function __construct()
    {
        $this->konfirmasiModel = new KonfirmasiModel();
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->ongkirModel = new OngkirModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    public function index($id)
    {
        //return view('pages/home');
        $data = [
            'title' => 'Konfirmasi Pembayaran|MJ Sport Collection',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray()
        ];
        return view('konfirmasi/index', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            'gambarBukti' => [
                'rules' => 'uploaded[gambarBukti]|max_size[gambarBukti,10240]|is_image[gambarBukti]|mime_in[gambarBukti,image/jpg,image/jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar (Hanya jpg. jpeg. dan png.)'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/transaksi'))->withInput();
        } else {
            //ambil gambar
            $fileGambar = $this->request->getFile('gambarBukti');

            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            //pindahkan ke folder
            $fileGambar->move('img/bukti', $namaGambar);

            // helper('date');
            // $now = date('Y-m-d H:i:s');
            //$dnow = "%Y-%M-%d %H:%i";

            //$myTime = Time::today('Asia/Jakarta');

            //untuk savenya
            $this->konfirmasiModel->save([
                'id_transaksiFK' => $this->request->getVar('id_transaksiFK'),
                'bukti' => $namaGambar
            ]);
            session()->setFlashdata('pesan', 'Konfirmasi Berhasil Ditambahkan, Mohon Menunggu Validasi');
            return redirect()->to(base_url('/transaksi'));
        }
    }
}
