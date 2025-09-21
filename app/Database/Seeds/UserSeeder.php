<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Define default users
        $users = [
            [
                'username' => 'superadmin',
                'password' => 'superadmin123',
                'role'     => 'superadmin',
            ],
            [
                'username' => 'admin',
                'password' => 'admin123',
                'role'     => 'admin',
            ],
            [
                'username' => 'user',
                'password' => 'user123',
                'role'     => 'user',
            ],
        ];

        foreach ($users as $user) {
            // Insert into users table
            $db->table('users')->insert([
                'username'   => $user['username'],
                'active'     => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]);

            $userId = $db->insertID();

            // Insert into auth_identities
            $db->table('auth_identities')->insert([
                'user_id'    => $userId,
                'type'       => 'email_password',
                'secret'     => $user['username'],
                'secret2'    => service('passwords')->hash($user['password']),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]);

            // Assign role (make sure roles exist in auth_groups)
            $db->table('auth_groups_users')->insert([
                'group'   => $user['role'],
                'user_id' => $userId,
            ]);
        }
    }
}
