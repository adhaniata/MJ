<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Myth\Auth\Password;

class Akun extends BaseController
{
    public function __construct(){
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        profil();
    }

    public function profil()
    {
        //merapihkan dan untuk ditampilkan di view
        $data = [
            'title' => 'Profil | MJ Sport Collection',
            'user' => $this->userModel->find(user_id()),
            'validation' => \Config\Services::validation()
        ];
        return view('akun/profil', $data);
    }

    public function update_profil(){
        $user = $this->userModel->find(user_id());

        if (!$this->validate([
            //untuk menampilkan bahasa error yang kita inginkan
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],'telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/akun/profil'))->withInput();
        } else {
            $this->userModel->update($user['id'], [
                'nama' => $this->request->getVar('nama'),
                'alamat' => $this->request->getVar('alamat'),
                'telp' => $this->request->getVar('telp'),
            ]);
            return redirect()->to(base_url('/akun/profil'));
        }
    }

    public function password(){
        $data = [
            'title' => 'Password | MJ Sport Collection',
            'validation' => \Config\Services::validation()
        ];
        return view('akun/password', $data);
    }

    public function update_password(){
        $user = $this->userModel->find(user_id());
        $pass_baru = $this->request->getVar('pass_baru');
        $pass_konf = $this->request->getVar('pass_konf');

        if (!$this->validate([
            //untuk menampilkan bahasa error yang kita inginkan
            'pass_baru' => [
                'label' => 'Password Baru',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],'pass_konf' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[pass_baru]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => 'Password baru tidak sama.',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/akun/password'))->withInput();
        } else {
            $this->userModel->update($user['id'], [
                'password_hash' => Password::hash($pass_konf),
            ]);
            return redirect()->to(base_url('/akun/password'));
        }
    }
}
