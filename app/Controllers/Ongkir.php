<?php

namespace App\Controllers;
//untuk konstruktor
use App\Models\OngkirModel;

class Ongkir extends BaseController
{
    //properti
    protected $OngkirModel;

    //konstruktor agar mempermudah dalam memanggil model dan semua method bisa
    public function __construct()
    {
        $this->ongkirModel = new OngkirModel();
    }
    public function index()
    {
        //cara konek db tanpa model
        //$db = \Config\Database::connect();

        //return view('pages/home');

        //memanggil semua data yang ada di db
        //ini dikomen karena sudah memakai method sendiri di modelOngkir dengan nama getOngkir
        //$ongkir = $this->ongkirModel->findAll();

        $data = [
            'title' => 'Daftar Biaya Kirim|MJ Sport Collection',
            //ongkir' => $ongkir
            'ongkir' => $this->ongkirModel->getOngkir()
        ];
        return view('ongkir/index', $data);
    }
    public function detail($slug)
    {
        //$ongkir = $this->ongkirModel->where(['slug' => $slug])->first();  //tidak digunakan karena menggunakan method model
        //$ongkir = $this->ongkirModel->getOngkir($slug); // jika memakai method model sendiri dan method detail controller
        //dd($ongkir);
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Detail Ongkir| MJ Sport Collection',
            'ongkir' => $this->ongkirModel->getOngkir($slug)
        ];

        //jika ongkir tidak ada di variable
        if (empty($data['ongkir'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Provinsi ' . $slug . ' tidak ditemukan');
        }

        return view('ongkir/detail', $data);
    }
}
