<?php

namespace App\Models;

use CodeIgniter\Model;

class KonfirmasiModel extends Model
{
    protected $table = 'konfirmasi';
    protected $primaryKey = 'id_konfirmasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksiFK', 'bukti', 'validasi'];

    public function getKonfirmasi($id)
    {
        return $this->where('id_transaksi', $id)->join('konfirmasi', 'konfirmasi.id_transaksiFK = transaksi.id_transaksi')->first();
    }
}
