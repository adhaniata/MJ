<?php

namespace App\Controllers;

//use App\Models\TransaksiModel;
use App\Models\{KeranjangModel, ProdukModel, TransaksiModel, OngkirModel, TransaksiDetailModel, PengembalianModel, UlasanModel};

class Transaksi extends BaseController
{
    protected $TransaksiModel;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->ongkirModel = new OngkirModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->ulasanModel = new UlasanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Transaksi Saya |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/index', $data);
    }

    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([

            //untuk menampilkan bahasa error yang kita inginkan
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('/keranjang/checkout'))->withInput();
        } else {
            //untuk savenya
            $transaksi = $this->transaksiModel->save([
                'id_userFK' => user_id(),
                'ongkir' => $this->request->getVar('ongkos_kirim'),
                'nama' => $this->request->getVar('nama'),
                'telp' => $this->request->getVar('telp'),
                'alamat' => $this->request->getVar('alamat'),
                'total_tagihan' => $this->request->getVar('total_tagihan'),
                'status_pembayaran' => 'MENUNGGU PEMBAYARAN',
            ]);

            // ambil keranjang user
            $keranjang = $this->keranjangModel->where('id_userFK', user_id())->join('produk', 'produk.id_produk = keranjang.id_produkFK')->get()->getResultArray();

            // masukkan data keranjang ke dalam table transaksi detail
            foreach ($keranjang as $k) {
                $transaksi_detail = $this->transaksiDetailModel->save([
                    'id_transaksiFK' => $this->transaksiModel->getInsertID(),
                    'id_produkFK' => $k['id_produkFK'],
                    'total_harga' => $k['total_harga'],
                    'qty' => $k['qty'],
                    'subtotal_harga' => $k['subtotal_harga']
                ]);

                // update stok produk yang sudah terjual
                $this->produkModel->where('id_produk', $k['id_produkFK'])->decrement('stok', $k['qty']);
            }

            // delete keranjang user
            $this->keranjangModel->where('id_userFK', user_id())->delete();

            session()->setFlashdata('pesan', 'Data Membuat Pesanan, Silahkan Bayar Sesuai Nominal dan Sertakan Bukti Pembayaran');
            return redirect()->to(base_url('/transaksi'));
        }
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('transaksi/detail', $data);
    }

    public function delete($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        $transaksi_detail = $this->transaksiDetailModel->where('id_transaksiFK', $id)->get()->getResultArray();
        // masukkan data keranjang ke dalam table transaksi detail
        foreach ($transaksi_detail as $td) {
            $this->produkModel->where('id_produk', $td['id_produkFK'])->increment('stok', $td['qty']);
        }
        $this->transaksiModel->delete($id);
        return redirect()->to(base_url('/transaksi'));
    }

    public function konfirmasi($id)
    {
        $data = [
            'title' => 'Konfirmasi Pembayaran|MJ Sport Collection',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray()
        ];
        return view('transaksi/konfirmasi', $data);
    }

    public function save_konfirmasi()
    {
        $id_transaksi = $this->request->getVar('id_transaksi');
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
            return redirect()->to(base_url('/transaksi/konfirmasi/' . $id_transaksi))->withInput();
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
            $this->transaksiModel->update($id_transaksi, [
                'bukti_konfirmasi' => $namaGambar,
                'tgl_konfirmasi' => date('Y-m-d H:i:s')
            ]);
            session()->setFlashdata('pesan', 'Konfirmasi Berhasil Ditambahkan, Mohon Menunggu Validasi');
            return redirect()->to(base_url('/transaksi'));
        }
    }
    public function pengembalian($id)
    {
        $data = [
            'title' => 'Form Pengembalian Barang|MJ Sport Collection',
            'validation' => \Config\Services::validation(),
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
            'cek_pengembalian' => $this->pengembalianModel->where('id_transaksiFK', $id)->countAllResults(),
            'pengembalian' => $this->pengembalianModel->where('id_transaksiFK', $id)->first()
        ];
        return view('transaksi/pengembalian', $data);
    }
    public function proses_pengembalian($id){
        if (!$this->validate([
            //cara mudah tanpa mengubah bahasa error yang tampil
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            //untuk menampilkan bahasa error yang kita inginkan
            'alasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'gambarPengembalian' => [
                'rules' => 'uploaded[gambarPengembalian]|max_size[gambarPengembalian,10240]|is_image[gambarPengembalian]|mime_in[gambarPengembalian,image/jpg,image/jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar (Hanya jpg. jpeg. dan png.'
                ]
            ],
            'resi_pengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'rek_pengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('transaksi/pengembalian/'.$id))->withInput();
        } else {

            //ambil gambar
            $fileGambar = $this->request->getFile('gambarPengembalian');

            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            //pindahkan ke folder
            $fileGambar->move('img/pengembalian', $namaGambar);


            //pindahkan ke folder tanpa di generete nama gambar random
            //$fileGambar->move('img/ongkir');
            //ambil nama file gambar
            //$namaGambar = $fileGambar->getName();


            //untuk savenya
            //dd($this->request->getVar());
            $cek = $this->pengembalianModel->save([
                'id_transaksiFK' => $id,
                'alasan' => $this->request->getVar('alasan'),
                'gambar' => $namaGambar,
                'resi_pengembalian' => $this->request->getVAr('resi_pengembalian'),
                'rek_pengembalian' => $this->request->getVAr('rek_pengembalian'),
                'validasi' => $this->request->getVAr('validasi'),
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/transaksi'));
        }
    }
    public function ulasan($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'validation' => \Config\Services::validation(),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
            'cek_ulasan' => $this->ulasanModel->where('id_transaksiFK', $id)->get()->getResultArray()
        ];

        return view('transaksi/ulasan', $data);
    }
}
