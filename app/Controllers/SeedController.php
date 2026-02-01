<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SeedController extends Controller
{
    public function index()
    {
        if (ENVIRONMENT !== 'development') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $seeder = \Config\Database::seeder();
        $seeder->call('PartTwoApplicantUserSeeder');
        //$seeder->call('UserSeeder');

        return 'Seeder executed successfully';
    }
}
