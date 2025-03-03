<?php

namespace App\Controllers;

class Application extends BaseController
{
    public function index()
    {
        $data = [
            'title'     => 'Application Information',
            'routeName' => 'applications',
            //'applicants' => $this->applicantModel->getApplicants(),
        ];

        return view('Application/index', $data);
    }
}
