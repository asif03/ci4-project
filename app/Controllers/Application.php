<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;

class Application extends BaseController
{
    protected $applicationModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicantInformationModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Application',
            'pageTitle' => 'Application Information',
        ];

        return view('Application/index', $data);
    }

    public function getSearchedApplicants()
    {
        $request = service('request');

        // Get DataTables parameters
        $draw        = $request->getPost('draw');
        $start       = $request->getPost('start');
        $length      = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Fetch data from model
        $data          = $this->applicationModel->getData($searchValue, $start, $length);
        $totalRecords  = $this->applicationModel->countAllData();
        $totalFiltered = $this->applicationModel->countFilteredData($searchValue);

        $response = [
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function getFilesInfo()
    {
        $request = service('request');

        $applicationId = $request->getPost('applicationId');

        $files = $this->applicationModel->getAttachements($applicationId);

        return view('Application/view-attachments', ['files' => $files]);
    }

}