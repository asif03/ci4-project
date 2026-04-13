<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PartTwoApplicantUserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Fetch all applicants
        $applicants = $db->table('fcps_one_pass_applicants')
            ->where('id >', 33273)
            ->get()
            ->getResult();

        //dd($applicants);

        foreach ($applicants as $applicant) {
            // Insert user
            $db->table('users')->insert([
                'username'   => $applicant->reg_no,
                'active'     => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'full_name'  => $applicant->applicant_name,
            ]);

            $userId = $db->insertID();

            // Insert into auth_identities
            $db->table('auth_identities')->insert([
                'user_id'    => $userId,
                'type'       => 'email_password', // adjust if your shield uses different type
                'name'       => $applicant->applicant_name,
                'secret'     => $applicant->reg_no,
                'secret2'    => service('passwords')->hash($applicant->password),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]);

            // Assign to user group
            $db->table('auth_groups_users')->insert([
                'user_id' => $userId,
                'group'   => 'user', // must exist in auth_groups
            ]);
        }
    }
}
