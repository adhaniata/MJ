<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_adminFK', 'id_transaksiFK', 'alasan', 'gambar', 'no_resi', 'rek_pengembalian', 'validasi'];
}
