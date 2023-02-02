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

    public function tampilanBelumBayar()
    {
        $data = [
            'title' => 'Transaksi Belum Di Bayar |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->where('status_pembayaran', 'MENUNGGU PEMBAYARAN')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/belumbayar', $data);
    }

    public function tampilanBatal()
    {
        $data = [
            'title' => 'Transaksi Batal |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->where('status_pengiriman', 'Batal')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/batal', $data);
    }

    public function tampilanProses()
    {
        $data = [
            'title' => 'Transaksi Sedang Di Proses |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->where('validasi', 'VALID')->where('status_pengiriman', 'PROSES PENGIRIMAN')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/proses', $data);
    }
    public function tampilanSelesai()
    {
        $data = [
            'title' => 'Transaksi Selesai |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->where('status_pengiriman', 'DITERIMA')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/selesai', $data);
    }
    public function tampilanPengembalian()
    {
        $data = [
            'title' => 'Daftar Pengembalian |MJ Sport Collection',
            // 'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->join('pengembalian', 'pengembalian.id_transaksiFK = transaksi.id_transaksi')->where('pengembalian.validasi', 'Valid')->get()->getResultArray(),
            'transaksi' => $this->transaksiModel->where('id_userFK', user_id())->join('pengembalian', 'pengembalian.id_transaksiFK = transaksi.id_transaksi')->where('status_pengiriman', 'PENGEMBALIAN')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/daftar_pengembalian', $data);
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
    public function detailAll($id)
    {
        $data = [
            'title' => 'Transaksi Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('transaksi/detail-index', $data);
    }

    public function detailSelesai($id)
    {
        $data = [
            'title' => 'Transaksi Selesai Detail |MJ Sport Collection',
            'transaksi' => $this->transaksiModel->find($id),
            'transaksi_detail' => $this->transaksiDetailModel->where('id_transaksiFK', $id)->join('produk', 'produk.id_produk = transaksi_detail.id_produkFK')->get()->getResultArray(),
        ];

        return view('transaksi/detail-selesai', $data);
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

    public function batal($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        $transaksi_detail = $this->transaksiDetailModel->where('id_transaksiFK', $id)->get()->getResultArray();
        // masukkan data keranjang ke dalam table transaksi detail
        foreach ($transaksi_detail as $td) {
            $this->produkModel->where('id_produk', $td['id_produkFK'])->increment('stok', $td['qty']);
        }
        $this->transaksiModel->save([
            'id_transaksi' => $id,
            'status_pengiriman' => 'Batal',
            'status_pembayaran' => 'Batal',
        ]);
        session()->setFlashdata('pesan', 'Pesanan Berhasil Dibatalkan');
        return redirect()->to(base_url('/transaksi/batal'));
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
            $fileGambar->move('img/konfirmasi', $namaGambar);

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
    public function proses_pengembalian($id)
    {
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
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,10240]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar (Hanya jpg. jpeg. dan png.'
                ]
            ],
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('transaksi/pengembalian/' . $id))->withInput();
        } else {

            //ambil gambar
            $fileGambar = $this->request->getFile('gambar');

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
            $this->pengembalianModel->save([
                'id_transaksiFK' => $id,
                'alasan' => $this->request->getVar('alasan'),
                'gambar' => $namaGambar,
                'validasi' => $this->request->getVAr('validasi')
            ]);

            $this->transaksiModel->save([
                'id_transaksi' => $id,
                'status_pengiriman' => 'PENGEMBALIAN',
            ]);


            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/transaksi'));
        }
    }
    public function update_pengembalian($id)
    {
        if (!$this->validate([
            //cara mudah tanpa mengubah bahasa error yang tampil
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            //untuk menampilkan bahasa error yang kita inginkan
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
            return redirect()->to(base_url('transaksi/pengembalian/' . $id))->withInput();
        } else {
            //untuk savenya
            //dd($this->request->getVar());
            $this->pengembalianModel->save([
                'id_pengembalian' => $id,
                'resi_pengembalian' => $this->request->getVAr('resi_pengembalian'),
                'rek_pengembalian' => $this->request->getVAr('rek_pengembalian'),
                'status' => 'Pengiriman Produk Retur',
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
        ];

        // update status
        $this->transaksiModel->save([
            'id_transaksi' => $id,
            'status_pengiriman' => 'DITERIMA',
        ]);

        return view('transaksi/ulasan', $data);
    }

    public function save_ulasan($id)
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //untuk menampilkan bahasa error yang kita inginkan
            'isi_ulasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('transaksi/ulasan/' . $this->request->getVar('id_transaksiFK')))->withInput();
        }
        //untuk savenya
        $this->transaksiDetailModel->update($id, [
            'id_userFK' => user_id(),
            'isi_ulasan' => $this->request->getVar('isi_ulasan')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasi Ditambahkan, Terimakasih Atas Ulasannya');
        return redirect()->to(base_url('transaksi'));
    }
}
