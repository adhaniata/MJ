<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_ongkirFK', 'id_keranjangFK', 'alamat', 'telp', 'total_tagihan', 'status_pembayaran', 'tgl_transaksi', 'no_resi', 'status_pengiriman'];

    public function getTransaksi()
    {
        return $this->db->table('transaksi')
            ->join('keranjang', 'keranjang.id_keranjang=transaksi.id_keranjangFK')
            ->join('ongkir', 'ongkir.id_ongkir=transaksi.id_ongkirFK')
            ->get()->getResultArray();
    }
    public function get_listOngkir()
    {
        $data = $this->query('SELECT id_ongkir, kota, harga 
        FROM ongkir');
        return $data->getResultArray();
    }
    public function getTagihan()
    {
    }
}
