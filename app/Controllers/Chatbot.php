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
            'title' => 'Chatbot |MJ Sport Collection'
        ];
        return view('chatbot/index', $data);
    }
}
