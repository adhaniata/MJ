<?php

namespace App\Models;

use CodeIgniter\Model;

class KonfirmasiModel extends Model
{
    protected $table = 'konfirmasi';
    protected $primaryKey = 'id_konfirmasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_adminFK', 'id_transaksiFK', 'tanggal_konfirmasi', 'bukti', 'validasi'];
}
