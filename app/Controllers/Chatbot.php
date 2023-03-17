<?php

namespace App\Controllers;

use App\Models\ChatbotModel;

class Chatbot extends BaseController
{
    protected $ChatbotModel;
    public function __construct()
    {
        $this->chatbotModel = new ChatbotModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Chatbot |MJ Sport Collection',
            'chatbot' => $this->chatbotModel->findAll(),
        ];

        return view('chatbot/index', $data);
    }

    function kirim()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $pesan = $this->request->getVar('pesan');
        $pesan = preg_replace("/[^a-zA-Z- ]/", "", $pesan);
        $keywords = explode(' ', $pesan);

        $query='';
        foreach ($keywords as $key => $values) {
            $values = trim($values);
            $query = $this->chatbotModel->orWhere("`pertanyaan` LIKE '%$values%'");
        }

        // $cek_data = $this->chatbotModel->like('pertanyaan', $request->getVar('pesan'))->get();

        // $balas = '';
        //jika pertanyaan/data ditemukan, maka tampilkan jawaban
        // if ($query->get()->getRowArray() != NULL) {
        //     //hasil query tampung kedalam variable data
        //     $data = $query->get()->getRowArray();
        //     var_dump($data); die;

        //     //tampung jawaban kedalam variable untuk dikirim kembali keajax
        //     $balas = $data;
        // } else {
        //     $balas = "Maaf, tidak menemukan jawaban yang kamu maksud. Kamu bisa Menghubungi Kami Melalui WhatsApp <a href='http://wa.me/6281212740577' target='_blank'> Klik Disini</a>";
        // }

        echo json_encode(['result' => $query->get()->getRowArray()]);
    }
}
