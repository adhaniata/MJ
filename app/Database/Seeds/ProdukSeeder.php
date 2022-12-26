<?php

namespace App\Database\Seeds;

use Myth\Auth\Password;

class ProdukSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kategoriFK'  => 2,
                'nama_produk'    => 'Jersey Mizuno Motif 1 Merah Size M',
                'slug_produk'    => 'jersey-mizuno-motif-1-merah-size-m',
                'harga_produk'   => 40000,
                'stok'           => 25,
                'gambar'         => 'jerseymizunovariasi1merah.jpeg',
                'deskripsi'      => 'Bahan berkualitas, size M',
                'size'           => 'M',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id_kategoriFK'  => 2,
                'nama_produk'    => 'Jersey Mizuno Motif 1 Biru Size M',
                'slug_produk'    => 'jersey-mizuno-motif-1-biru-size-m',
                'harga_produk'   => 40000,
                'stok'           => 25,
                'gambar'         => 'jerseymizunovariasi1biru.jpeg',
                'deskripsi'      => 'Bahan berkualitas, size M',
                'size'           => 'M',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id_kategoriFK'  => 2,
                'nama_produk'    => 'Jersey Mizuno Motif 1 Kuning Size L',
                'slug_produk'    => 'jersey-mizuno-motif-1-kuning-size-L',
                'harga_produk'   => 40000,
                'stok'           => 25,
                'gambar'         => 'jerseymizunovariasi1kuning.jpeg',
                'deskripsi'      => 'Bahan berkualitas, size L',
                'size'           => 'L',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('produk')->insertBatch($data);
    }
}
