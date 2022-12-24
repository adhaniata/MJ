<?php namespace App\Database\Seeds;
use Myth\Auth\Password;
  
class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data_user = [
            [
                'email'          => 'admin@admin.com',
                'username'       => 'admin',
                'password_hash'  => Password::hash('terserahlah123'),
                'active'         => 1,
                'activate_hash'  => bin2hex(random_bytes(16)),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'email'          => 'user@user.com',
                'username'       => 'user',
                'password_hash'  => Password::hash('terserahlah123'),
                'active'         => 1,
                'activate_hash'  => bin2hex(random_bytes(16)),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('users')->insertBatch($data_user);

        $data_group = [
            [
                'name'          => 'admin',
                'description'   => 'Admin'
            ],
            [
                'name'          => 'user',
                'description'   => 'User'
            ]
        ];
        $this->db->table('auth_groups')->insertBatch($data_group);

        $data_group_user = [
            [
                'group_id' => 1,
                'user_id'  => 1
            ],
            [
                'group_id' => 2,
                'user_id'  => 2
            ]
        ];
        $this->db->table('auth_groups_users')->insertBatch($data_group_user);
    }
}