<?php

namespace App\Controllers\Admin;

use App\Models\{ProdukModel, KategoriModel};
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Produk extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {
        //cara konek db tanpa model
        //$db = \Config\Database::connect();
        //return view('pages/home');
        //memanggil semua data yang ada di db
        //ini dikomen karena sudah memakai method sendiri di modelOngkir dengan nama getOngkir
        //$ongkir = $this->ongkirModel->findAll();
        $data = [
            'title' => 'Produk |MJ Sport Collection',
            //ongkir' => $ongkir
            'produk' => $this->produkModel->getProdukAdmin(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        return view('admin/produk/index', $data);
    }
    public function detail($slug_produk)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Produk| MJ Sport Collection',
            'produk' => $this->produkModel->getProdukAdmin($slug_produk)
        ];
        //jika produk tidak ada di variable
        if (empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk ' . $slug_produk . ' tidak ditemukan');
        }
        return view('admin/produk/detail', $data);
    }
    public function create()
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        $data = [
            'title' => 'Form Tambah Produk',
            'validation' => \Config\Services::validation(),
            //'listAdmin' => $this->produkModel->get_listAdmin(),
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        return view('admin/produk/create', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //cara mudah tanpa mengubah bahasa error yang tampil
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            //untuk menampilkan bahasa error yang kita inginkan
            'id_kategoriFK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required|is_unique[produk.nama_produk]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf'
                ]
            ],
            'gambarProduk' => [
                'rules' => 'uploaded[gambarProduk]|max_size[gambarProduk,10240]|is_image[gambarProduk]|mime_in[gambarProduk,image/jpg,image/jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar (Hanya jpg. jpeg. dan png.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'size' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('admin/produk/create'))->withInput();
        } else {

            //dd($this->request->getVar());
            // dd('test berhasil upload gambar'); //sudah berhasil ternyata

            //ambil gambar
            $fileGambar = $this->request->getFile('gambarProduk');

            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            //pindahkan ke folder
            $fileGambar->move('img/produk', $namaGambar);


            //pindahkan ke folder tanpa di generete nama gambar random
            //$fileGambar->move('img/ongkir');
            //ambil nama file gambar
            //$namaGambar = $fileGambar->getName();


            //untuk savenya
            //dd($this->request->getVar());
            $slug_produk = url_title($this->request->getVar('nama_produk'), '-', true);
            $this->produkModel->save([
                'id_kategoriFK' => $this->request->getVar('id_kategoriFK'),
                'nama_produk' => $this->request->getVar('nama_produk'),
                //'id_adminFK' => $this->request->getVar('id_adminFK'),
                'slug_produk' => $slug_produk,
                'harga_produk' => $this->request->getVAr('harga_produk'),
                'stok' => $this->request->getVAr('stok'),
                'gambar' => $namaGambar,
                'deskripsi' => $this->request->getVAr('deskripsi'),
                'size' => $this->request->getVAr('size')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/admin/produk'));
        }
    }
    public function delete($id)
    {
        //cari gambar berdasarkan id
        $produk = $this->produkModel->find($id);
        //cek gambar berdasarkan id, jika default tidak dihapus file gambarnya
        unlink('img/produk/' . $produk['gambar']);
        $this->produkModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to(base_url('/admin/produk'));
    }
    public function edit($slug_produk)
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        helper('form');
        $data = [
            'title' => 'Form Edit Data Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getProdukAdmin($slug_produk),
            'listKategori' => $this->produkModel->get_listKategori()
        ];
        return view('admin/produk/edit', $data);
    }
    public function update($id)
    {
        helper('form');
        //test apakah data sudah terkirim
        //dd($this->request->getVar());

        //cek produk (berguna untuk menghindari rules required dan is unique)
        $produkLama = $this->produkModel->getProdukAdmin($this->request->getVar('slug_produk'));
        if ($produkLama['nama_produk'] == $this->request->getVar('nama_produk')) {
            $rule_produk = 'required';
        } else {
            $rule_produk = 'required|is_unique[produk.nama_produk]';
        }


        //validasi input
        if (!$this->validate([
            //kalau menggunakan ini akan banyak error maka akan dikondisikan
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            'id_kategoriFK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nama_produk' => [
                'rules' => $rule_produk,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf'
                ]
            ],
            'gambarProduk' => [
                'rules' => 'uploaded[gambarProduk]|max_size[gambarProduk,10240]|is_image[gambarProduk]|mime_in[gambarProduk,image/jpg,image/jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar berformat jpg, jpeg, dan png'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'size' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            //return redirect()->to(base_url('admin/ongkir/edit/' . $this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('admin/produk/edit/' . $this->request->getVar('slug_produk')))->withInput();
        } else {

            //ambil gambar
            $fileGambar = $this->request->getFile('gambarProduk');

            //apakah tidak ada gambar yang diupload
            if ($fileGambar->getError() == 4) {
                $namaGambar = $this->request->getVar('gambarProdukLama');
            } else {
                //generate nama gambar random
                $namaGambar = $fileGambar->getRandomName();
                //pindahkan ke folder
                $fileGambar->move('img/produk', $namaGambar);
                //hapus file gambarlama di folder img/ongkir
                //unlink('img/produk/' . $this->request->getVar('gambarProdukLama'));
            }

            //method savenya

            $slug_produk = url_title($this->request->getVar('nama_produk'), '-', true);
            $this->produkModel->save([
                'id_produk' => $id,
                'id_kategoriFK' => $this->request->getVar('id_kategoriFK'),
                'nama_produk' => $this->request->getVar('nama_produk'),
                //'id_adminFK' => $this->request->getVar('id_adminFK'),
                'slug_produk' => $slug_produk,
                'harga_produk' => $this->request->getVAr('harga_produk'),
                'stok' => $this->request->getVAr('stok'),
                'gambar' => $namaGambar,
                'deskripsi' => $this->request->getVAr('deskripsi'),
                'size' => $this->request->getVAr('size')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('/admin/produk'));
        }
    }
    public function cari()
    {
        $cari = $this->request->getVar('cari');

        $data = [
            'title' => 'Hasil Pencarian |MJ Sport Collection',
            'produk' => $this->produkModel->like('nama_produk', $cari)->get()->getResultArray(),
            'count' => $this->produkModel->countAllResults()
        ];

        return view('admin/produk/index', $data);
    }
    public function proses()
    {
        $filter = $this->request->getVar('filter');
        $type = $this->request->getVar('type');
        $kategori = $this->kategoriModel->where('id_kategori', $filter)->first();
        // cek filter
        if ($filter != '') {
            $produk = $this->produkModel->where('id_kategoriFK', $filter)->join('kategori', 'kategori.id_kategori = produk.id_kategoriFK')->get()->getResultArray();
            $ket = 'Laporan Produk Penjualan MJ Sport Kategori ' . $kategori['nama_kategori'];
        } else {
            $produk = $this->produkModel->findAll();
            $ket = 'Laporan Semua Produk Penjualan MJ Sport';
        }

        // cek type cetak
        if ($type == 'pdf') {
            $data = [
                'title' => 'Daftar Produk |MJ Sport Collection',
                'produk' => $produk,
                'count' => $this->produkModel->countAllResults(),
                'ket' => $ket
            ];

            $html = view('admin/produk/export-pdf', $data);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream("Laporan Produk Penjualan MJ Sport", array("Attachment" => false));
        } else {
            $spreadsheet = new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', $ket)
                ->mergeCells('A1:I1')
                ->setCellValue('A3', 'No')
                ->setCellValue('B3', 'ID Produk')
                ->setCellValue('C3', 'Kategori')
                ->setCellValue('D3', 'Nama Produk')
                ->setCellValue('E3', 'Harga (Rupiah)')
                ->setCellValue('F3', 'Stok')
                ->setCellValue('G3', 'Gambar')
                ->setCellValue('H3', 'Deskripsi')
                ->setCellValue('I3', 'Size');

            $column = 4;

            $i = 1;
            foreach ($produk as $p) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $i++)
                    ->setCellValue('B' . $column, $p['id_produk'])
                    ->setCellValue('C' . $column, $p['nama_kategori'])
                    ->setCellValue('D' . $column, $p['nama_produk'])
                    ->setCellValue('E' . $column, $p['harga_produk'])
                    ->setCellValue('F' . $column, $p['stok'])
                    ->setCellValue('G' . $column, $p['gambar'])
                    ->setCellValue('H' . $column, $p['deskripsi'])
                    ->setCellValue('H' . $column, $p['size']);

                $column++;
            }

            $writer = new Xlsx($spreadsheet);
            $filename = 'Laporan Produk Penjualan MJ Sport';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }
}
