<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_produk', 'id_kategoriFK', 'slug_produk', 'harga_produk', 'stok', 'gambar', 'deskripsi', 'size'];


    protected $db;
    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect();
    // }

    public function getProduk($slug_produk = false)
    {
        if ($slug_produk == false) {
            return $this->findAll();
        }
        return $this->where(['slug_produk' => $slug_produk])->first();
    }
    public function getProdukAdmin($slug_produk = false)
    {
        if ($slug_produk == false) {
            // $db      = \Config\Database::connect();
            // $builder = $db->table('produk');
            // $builder->join('admin', 'admin.id_admin=produk.id_adminFK');
            // $builder->join('kategori', 'kategori.id_kategori=produk.id_kategoriFK');
            // $query = $builder->get();
            // return $query;
            return $this->db->table('produk')
                //->join('admin', 'admin.id_admin=produk.id_adminFK')
                ->join('kategori', 'kategori.id_kategori=produk.id_kategoriFK')
                ->get()->getResultArray();
            // $query = $db->query('select id_produk, harga, stok, gambar, deskripsi, size, nama_admin from produk p left join
            // admin a on p.id_adminFK=a.id_admin, nama_kategori from produk p left join kategori k on p.id_kategoriFK=k.id_kategori');
            // $result = $query->getResultArray();
        } else {
        //return $this->where(['slug_produk' => $slug_produk])->first();
            
        // untuk ambil banyak data
        // return $this->db->table('produk')
        //     //->join('admin', 'admin.id_admin=produk.id_adminFK')
        //     ->join('kategori', 'kategori.id_kategori=produk.id_kategoriFK')
        //     ->where('slug_produk', $slug_produk)
        //     ->get()->getResultArray();

        // untuk ambil 1 baris data
        return $this->where('slug_produk', $slug_produk)->join('kategori', 'kategori.id_kategori = produk.id_kategoriFK')->first();
        }
    }

    //sudah bisa
    // public function get_adminProduk()
    // {
    //     return $this->db->table('produk')
    //         ->join('admin', 'admin.id_admin=produk.id_adminFK')
    //         ->join('kategori', 'kategori.id_kategori=produk.id_kategoriFK')
    //         ->get()->getResultArray();
    // }
    // public function get_listAdmin()
    // {
    //     // $query = $this->db->table('produk');
    //     // return $query->get()->getResultArray();
    //     $data = $this->query('select id_admin, nama_admin from admin');
    //     return $data->getResultArray();
    // }
    public function get_listKategori()
    {
        // $query = $this->db->table('produk');
        // return $query->get()->getResultArray();
        //$data = $this->query('select id_kategori, nama_kategori from kategori');
        $data = $this->query('SELECT id_kategori, nama_kategori 
        FROM kategori');
        return $data->getResultArray();
    }
}
