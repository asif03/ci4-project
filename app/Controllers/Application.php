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
        $statisticsData = $this->applicationModel->getStatistics();

        $data = [
            'title'      => 'Application',
            'pageTitle'  => 'Application Information',
            'statistics' => $statisticsData,
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

    public function approveApplicant()
    {
        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        $isApproved = $this->applicationModel->approveApplicant($applicantId);

        if ($isApproved) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Applicant approved successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to approve applicant.']);
        }
    }

    public function rejectApplicant()
    {
        $request = service('request');

        $applicantId  = $request->getPost('applicantId');
        $rejectReason = $request->getPost('rejectReason');

        $isRejected = $this->applicationModel->rejectApplicant($applicantId, $rejectReason);

        if ($isRejected) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Applicant rejected successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to reject applicant.']);
        }
    }

}
