<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksiFK', 'alasan', 'gambar', 'resi_pengembalian', 'rek_pengembalian', 'validasi'];
}
