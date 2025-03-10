<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function profile()
    {
        // Get authenticated user
        $auth = service('authentication');
        $user = $auth->user();

        // Check if the user is logged in
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // Pass user data to the view
        return view('user/profile', ['user' => $user]);
    }

}
