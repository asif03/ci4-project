<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        // Get the authenticated user
        $user = auth()->user();

        //dd($user->inGroup);

        $data = [
            'title'     => 'Dashboard',
            'routeName' => 'dashboard',
            //'honorariums' => $this->honorariumModel->getHonorariums(),
        ];

        // Check if the user is in the 'admin' group
        if (!$user->inGroup('superadmin', 'admin')) {
            return view('trainee-dashboard', $data);
        } else {
            return view('dashboard', $data);
        }

        // The user is an admin, so load the dashboard view.
        //return view('dashboard');

    }
}
