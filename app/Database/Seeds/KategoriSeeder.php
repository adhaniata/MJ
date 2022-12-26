<?php

namespace App\Database\Seeds;

use Myth\Auth\Password;

class KategoriSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori'  => 'Sepatu',
                'slug_kategori'  => 'sepatu',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori'  => 'Pakaian',
                'slug_kategori'  => 'pakaian',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori'  => 'Aksesoris',
                'slug_kategori'  => 'aksesoris',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('kategori')->insertBatch($data);
    }
}
