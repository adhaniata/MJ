<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $useTimestamps = true;
    protected $allowedFields = ['username_admin', 'password_admin', 'nama_admin'];
}
