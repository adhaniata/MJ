<?php

namespace App\Controllers\Admin;

use App\Models\KategoriModel;
use App\Controllers\BaseController;

class Kategori extends BaseController
{
    protected $KategoriModel;
    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Kategori|MJ Sport Collection',
            'kategori' => $this->kategoriModel->getKategori()
        ];
        return view('admin/kategori/index', $data);
    }
    public function create()
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        $data = [
            'title' => 'Form Tambah Data Kategori',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/kategori/create', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //untuk menampilkan bahasa error yang kita inginkan
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/kategori/create'))->withInput();
        }
        //untuk savenya
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'slug_kategori' => $slug
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('/admin/kategori'));
    }
    public function delete($id)
    {
        //cari gambar berdasarkan id
        $kategori = $this->kategoriModel->find($id);
        $this->kategoriModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to(base_url('/admin/kategori'));
    }
    public function edit($slug)
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        helper('form');
        $data = [
            'title' => 'Form Edit Data Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->getKategori($slug)
        ];
        return view('admin/kategori/edit', $data);
    }
    public function update($id)
    {
        helper('form');
        //test apakah data sudah terkirim
        //dd($this->request->getVar());

        //cek provinsi (berguna untuk menghindari rules required dan is unique)
        $kategoriLama = $this->kategoriModel->getKategori($this->request->getVar('slug_kategori'));
        if ($kategoriLama['nama_kategori'] == $this->request->getVar('nama_kategori')) {
            $rule_kategori = 'required';
        } else {
            $rule_kategori = 'required|is_unique[kategori.nama_kategori]';
        }


        //validasi input
        if (!$this->validate([
            'nama_kategori' => [
                'rules' => $rule_kategori,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/kategori/edit/' . $this->request->getVar('slug_kategori')))->withInput();
        }

        //method savenya
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);
        $this->kategoriModel->save([
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'slug_kategori' => $slug
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to(base_url('/admin/kategori'));
    }
}
