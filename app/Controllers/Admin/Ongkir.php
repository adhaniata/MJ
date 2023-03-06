<?php

namespace App\Controllers\Admin;

use App\Models\OngkirModel;
use App\Controllers\BaseController;

class Ongkir extends BaseController
{
    protected $OngkirModel;
    public function __construct()
    {
        $this->ongkirModel = new OngkirModel();
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
            'title' => 'Daftar Biaya Kirim|MJ Sport Collection',
            //ongkir' => $ongkir
            'ongkir' => $this->ongkirModel->getOngkir()
            // 'ongkir' => $this->ongkirModel->paginate(10),
            // 'pager' => $this->ongkirModel->pager
        ];
        return view('admin/ongkir/index', $data);
    }
    public function detail($slug)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Ongkir| MJ Sport Collection',
            'ongkir' => $this->ongkirModel->getOngkir($slug)
        ];

        //jika ongkir tidak ada di variable
        if (empty($data['ongkir'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('kota ' . $slug . ' tidak ditemukan');
        }

        return view('admin/ongkir/detail', $data);
    }
    public function create()
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        $data = [
            'title' => 'Form Tambah Ongkir',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/ongkir/create', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //cara mudah tanpa mengubah bahasa error yang tampil
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            //untuk menampilkan bahasa error yang kita inginkan
            'kota' => [
                'rules' => 'required|is_unique[ongkir.kota]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf.'
                ]
            ],
            'gambarOngkir' => [
                'rules' => 'max_size[gambarOngkir,10240]|is_image[gambarOngkir]|mime_in[gambarOngkir,image/jpg,image.jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    //'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('admin/ongkir/create'))->withInput();
        }
        //dd($this->request->getVar());
        // dd('test berhasil upload gambar'); //sudah berhasil ternyata

        //ambil gambar
        $fileGambar = $this->request->getFile('gambarOngkir');

        //apakah tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'jnt.jpg';
        } else {
            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            //pindahkan ke folder
            $fileGambar->move('img/ongkir', $namaGambar);
        }

        //pindahkan ke folder tanpa di generete nama gambar random
        //$fileGambar->move('img/ongkir');
        //ambil nama file gambar
        //$namaGambar = $fileGambar->getName();


        //untuk savenya
        $slug = url_title($this->request->getVar('kota'), '-', true);
        $this->ongkirModel->save([
            'kota' => $this->request->getVar('kota'),
            'slug' => $slug,
            'harga' => $this->request->getVAr('harga'),
            'gambar' => $namaGambar
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('/admin/ongkir'));
    }
    public function delete($id)
    {
        //cari gambar berdasarkan id
        $ongkir = $this->ongkirModel->find($id);
        //cek gambar berdasarkan id, jika default tidak dihapus file gambarnya
        if ($ongkir['gambar'] != 'jnt.jpg') {
            //hapus gambar dari folder img/ongkir
            unlink('img/ongkir/' . $ongkir['gambar']);
        }
        $this->ongkirModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to(base_url('/admin/ongkir'));
    }
    public function edit($slug)
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        helper('form');
        $data = [
            'title' => 'Form Edit Data Ongkir',
            'validation' => \Config\Services::validation(),
            'ongkir' => $this->ongkirModel->getOngkir($slug)
        ];
        return view('admin/ongkir/edit', $data);
    }
    public function update($id)
    {
        helper('form');
        //test apakah data sudah terkirim
        //dd($this->request->getVar());

        //cek provinsi (berguna untuk menghindari rules required dan is unique)
        $ongkirLama = $this->ongkirModel->getOngkir($this->request->getVar('slug'));
        if ($ongkirLama['kota'] == $this->request->getVar('kota')) {
            $rule_kota = 'required';
        } else {
            $rule_kota = 'required|is_unique[ongkir.kota]';
        }


        //validasi input
        if (!$this->validate([
            //kalau menggunakan ini akan banyak error maka akan dikondisikan
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            'kota' => [
                'rules' => $rule_kota,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berisi angka bukan huruf'
                ]
            ],
            'gambarOngkir' => [
                'rules' => 'max_size[gambarOngkir,10240]|is_image[gambarOngkir]|mime_in[gambarOngkir,image/jpg,image.jpeg,image/png]',
                //jika wajib upload tambah uploaded[gambar] di rules
                'errors' => [
                    //'uploaded' => 'Pilih Gambar Terlebih dahulu',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            //return redirect()->to(base_url('admin/ongkir/edit/' . $this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('admin/ongkir/edit/' . $this->request->getVar('slug')))->withInput();
        }

        //dd($this->request->getVar());


        //ambil gambar
        $fileGambar = $this->request->getFile('gambarOngkir');

        //apakah tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarOngkirLama');
        } else {
            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            //pindahkan ke folder
            $fileGambar->move('img/ongkir', $namaGambar);
            //hapus file gambarlama di folder img/ongkir
            if ($this->request->getVar('gambarOngkirLama') != 'jnt.jpg') {
                unlink('img/ongkir/' . $this->request->getVar('gambarOngkirLama'));
            }
        }

        //method savenya
        $slug = url_title($this->request->getVar('kota'), '-', true);
        $this->ongkirModel->save([
            'id_ongkir' => $id,
            'kota' => $this->request->getVar('kota'),
            'slug' => $slug,
            'harga' => $this->request->getVAr('harga'),
            'gambar' => $namaGambar
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to(base_url('/admin/ongkir'));
    }
    public function cari()
    {
        $cari = $this->request->getVar('cari');

        $data = [
            'title' => 'Hasil Pencarian |MJ Sport Collection',
            'ongkir' => $this->ongkirModel->like('kota', $cari)->get()->getResultArray(),
            'count' => $this->ongkirModel->countAllResults()
        ];

        return view('admin/ongkir/index', $data);
    }
}
