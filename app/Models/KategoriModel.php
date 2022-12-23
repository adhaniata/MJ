<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $useTimestamps = true;
    protected $allowedFields = ['slug_kategori', 'nama_kategori'];

    public function getKategori($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug_kategori' => $slug])->first();
    }
}
