<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_transaksi_detail';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_transaksiFK', 'id_produkFK', 'id_userFK', 'total_harga', 'qty', 'subtotal_harga', 'isi_ulasan'];

    public function getUlasan($slug_produk)
    {
        return $this->db->table('transaksi_detail')
            ->join('transaksi', 'transaksi.id_transaksi=transaksi_detail.id_transaksiFK')
            ->join('produk', 'produk.id_produk=transaksi_detail.id_produkFK')
            ->where('slug_produk', $slug_produk)
            ->where('isi_ulasan is NOT NULL', NULL, FALSE)
            ->get()->getResultArray();
    }
}
