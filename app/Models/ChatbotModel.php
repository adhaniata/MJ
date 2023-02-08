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
    public function getJawaban($pertanyaan)
    {
        return $this->db->table('chatbot')
            ->select('jawaban')
            ->like('pertanyaan', $pertanyaan)
            ->get();
    }
}
