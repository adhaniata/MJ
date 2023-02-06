<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatbotModel extends Model
{
    protected $table = 'chatbot';
    protected $primaryKey = 'id_chatbot';
    protected $useTimestamps = true;
    protected $allowedFields = ['pertanyaan', 'jawaban'];

    public function getChatbot($id)
    {
        return $this->where('id_chatbot', $id)->first();
    }
}
