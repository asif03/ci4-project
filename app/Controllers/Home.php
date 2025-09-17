<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }

    public function registrationNoSms(): string
    {
        return view('registration_no_sms');
    }

    public function contactUs(): string
    {
        return view('contact');
    }
}
