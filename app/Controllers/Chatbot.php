<?php

namespace App\Controllers;

use App\Models\ChatbotModel;

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
            'title' => 'Chatbot |MJ Sport Collection',
        ];

        return view('chatbot/index', $data);
    }

    function kirim()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();

        $cek_data = $this->chatbotModel->like('pertanyaan', $request->getVar('pesan'))->get();

        $balas = '';
        //jika pertanyaan/data ditemukan, maka tampilkan jawaban
        if ($cek_data->getNumRows() > 0) {
            //hasil query tampung kedalam variable data
            $data = $cek_data->getRowArray();

            //tampung jawaban kedalam variable untuk dikirim kembali keajax
            $balas = $data['jawaban'];
        } else {
            $balas = "Maaf, tidak menemukan jawaban yang kamu maksud. Kamu bisa Menghubungi Kami Melalui WhatsApp <a href='wa.me/6281285173625' target='_blank'> Klik Disini</a>";
        }

        echo json_encode(['result' => $balas]);
    }
}
