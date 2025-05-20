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

    public function getApplicant($id)
    {
        $applicant = $this->applicationModel->find($id);
        return view('Application/edit', ['applicant' => $applicant]);
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

    public function edit($id)
    {
        $data = [
            'title'     => 'Application',
            'pageTitle' => 'Edit Application Information',
            'applicant' => $this->applicationModel->find($id),
        ];

        /*echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;*/

        return view('Application/edit', $data);
    }

    public function updateBasicInfo()
    {
        $request = service('request');

        $applicantId = $request->getPost('applicantId');
        $name        = $request->getPost('name');
        $fatherName  = $request->getPost('fatherName');
        $motherName  = $request->getPost('motherName');

        // Update applicant information
        $data = [
            'name'               => $name,
            'father_spouse_name' => $fatherName,
            'mother_name'        => $motherName,
        ];

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'Applicant information updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update applicant information.');
        }
    }

}
