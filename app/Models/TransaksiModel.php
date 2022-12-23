<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_adminFK', 'id_userFK', 'id_ongkirFK', 'id_keranjangFK', 'alamat', 'telp', 'total_tagihan', 'status_pembayaran', 'tgl_transaksi', 'no_resi', 'status_pengiriman'];
}
