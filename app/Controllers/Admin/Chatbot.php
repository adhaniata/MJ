<?php

namespace App\Controllers\Admin;

use App\Models\ChatbotModel;
use App\Controllers\BaseController;

class Chatbot extends BaseController
{
    protected $ChatbotModel;
    public function __construct()
    {
        $this->chatbotModel = new ChatbotModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Data Chatbot |MJ Sport Collection',
            'chatbot' => $this->chatbotModel->findAll(),
        ];
        return view('admin/chatbot/index', $data);
    }
    public function create()
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        $data = [
            'title' => 'Form Tambah Chatbot',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/chatbot/create', $data);
    }
    public function save()
    {
        //validasi input (sebelum save alangkah lebih baik memvalidaasi)
        if (!$this->validate([
            //cara mudah tanpa mengubah bahasa error yang tampil

            //untuk menampilkan bahasa error yang kita inginkan
            'pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jawaban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();  //kata ka sandika ini gausa karena dah ada di session
            //return redirect()->to(base_url('admin/ongkir/create'))->withInput()->with('validation', $validation); //yang ini katanya sampai di withInput() aja karena data sudah kekirim
            return redirect()->to(base_url('admin/chatbot/create'))->withInput();
        }

        //untuk savenya
        $pertanyaan = url_title($this->request->getVar('pertanyaan'), true);
        $this->chatbotModel->save([
            'pertanyaan' => $pertanyaan,
            'jawaban' => $this->request->getVar('jawaban')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('/admin/chatbot'));
    }
    public function delete($id)
    {
        $this->chatbotModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to(base_url('/admin/chatbot'));
    }
    public function edit($id)
    {
        //session(); //saya pindahkan session ke basecontroller agar tidak lupa
        helper('form');
        $data = [
            'title' => 'Form Edit Data Ongkir',
            'validation' => \Config\Services::validation(),
            'chatbot' => $this->chatbotModel->getChatbot($id)
        ];
        return view('admin/chatbot/edit', $data);
    }
    public function update($id)
    {
        helper('form');

        //validasi input
        if (!$this->validate([
            //kalau menggunakan ini akan banyak error maka akan dikondisikan
            //'provinsi' => 'required|is_unique[ongkir.provinsi]'

            'pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jawaban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();
            //return redirect()->to(base_url('admin/ongkir/edit/' . $this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('admin/chatbot/edit/' . $this->request->getVar('id_chatbot')))->withInput();
        }

        //method savenya strtolower($this->request->getVar('pertanyaan'))
        $pertanyaan = $this->request->getVar('pertanyaan');
        $this->chatbotModel->save([
            'id_chatbot' => $id,
            'pertanyaan' => $pertanyaan,
            'jawaban' => $this->request->getVAr('jawaban')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to(base_url('/admin/chatbot'));
    }
}
