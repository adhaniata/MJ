<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_userFK', 'id_produkFK', 'isi_ulasan'];
}
