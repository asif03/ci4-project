<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {

        $data = [
            'title'     => 'Dashboard',
            'routeName' => 'dashboard',
            //'honorariums' => $this->honorariumModel->getHonorariums(),
        ];

        return view('dashboard', $data);

    }
}
