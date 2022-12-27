<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_userFK', 'id_produkFK', 'qty', 'total_harga', 'subtotal_harga'];


    protected $db;
    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect();
    // }

    public function getKeranjang()
    {
        return $this->db->table('keranjang')
            ->join('users', 'users.id=keranjang.id_userFK')
            ->join('produk', 'produk.id_produk=keranjang.id_produkFK')
            ->get()->getResultArray();
    }
}
