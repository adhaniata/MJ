<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_transaksi_detail';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksiFK', 'id_produkFK', 'total_harga', 'qty', 'subtotal_harga'];
}
