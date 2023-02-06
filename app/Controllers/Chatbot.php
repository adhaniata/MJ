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
            'chatbot' => $this->chatbotModel->findAll(),
            // 'bls' => $this->chatbotModel->select('jawaban')->like('pertanyaan', $pesan)->get()->getResultArray(),
        ];
        //request
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            // mengambil pesan ajax
            $pesan = $request->getVar('isi_pesan');
            $cek_data = $this->chatbotModel->like('pertanyaan', $pesan)->get();

            //jika pertanyaan/data ditemukan, maka tampilkan jawaban
            if ($cek_data->getNumRows() > 0) {
                //hasil query tampung kedalam variable data
                $data = $cek_data->getResultArray();
                //tampung jawaban kedalam variable untuk dikirim kembali keajax
                $balasan = $data['jawaban'];
                echo $balasan;
            } else {
                echo "Maaf, tidak menemukan jawaban yang kamu maksud. Kamu bisa Menghubungi Kami Melalui WhatsApp <a href='wa.me/6281285173625' target='_blank'> Klik Disini</a>";
            }
        } else {
            return view('chatbot/index', $data);
        }
    }
}
