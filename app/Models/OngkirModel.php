<?php

namespace App\Models;

use CodeIgniter\Model;

class OngkirModel extends Model
{
    protected $table = 'ongkir';
    protected $primaryKey = 'id_ongkir';
    protected $useTimestamps = true;
    protected $allowedFields = ['kota', 'slug', 'harga', 'gambar'];

    public function getOngkir($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
