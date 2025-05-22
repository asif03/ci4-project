<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;
use App\Models\MbbsInstituteModel;
use App\Models\SpecialityModel;

class Application extends BaseController
{
    protected $applicationModel;
    protected $specialityModel;
    protected $mbbsInstituteModel;

    public function __construct()
    {
        $this->applicationModel   = new ApplicantInformationModel();
        $this->specialityModel    = new SpecialityModel();
        $this->mbbsInstituteModel = new MbbsInstituteModel();
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
            'title'          => 'Application',
            'pageTitle'      => 'Edit Application Information',
            'applicant'      => $this->applicationModel->find($id),
            'specialities'   => $this->specialityModel->where('status', true)->findAll(),
            'mbbsInstitutes' => $this->mbbsInstituteModel->where('status', true)->findAll(),
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

        if (!$applicantId) {
            return redirect()->back()->with('error', 'Invalid applicant ID.');
        }

        // Update applicant information
        $data = [
            'name'               => $request->getPost('name'),
            'father_spouse_name' => $request->getPost('fatherName'),
            'mother_name'        => $request->getPost('motherName'),
            'date_of_birth'      => $request->getPost('dob'),
            'nataionality'       => $request->getPost('nationality'),
            'religion'           => $request->getPost('religion'),
            'nid'                => $request->getPost('nid'),
            'address'            => $request->getPost('addressOfCommunication'),
            'telephone'          => $request->getPost('telephone'),
            'mobile'             => $request->getPost('mobile'),
            'email'              => $request->getPost('email'),
            'permanent_address'  => $request->getPost('permanentAddress'),
            'updated_at'         => date('Y-m-d H:i:s'),
            'updated_by'         => service('auth')->user()->id,
        ];

        if (!$this->validateData($data, [
            'name' => 'required',
            'nid'  => [
                'label'  => 'NID',
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'NID is required.',
                    'min_length' => 'NID at least 10 character in length.',
                ],
            ],
        ])) {
            // The validation failed.
            /*return view('login', [
            'errors' => $this->validator->getErrors(),
            ]);*/

            /*echo '<pre>';
            print_r($this->validator->getErrors());
            echo '</pre>';
            die;*/

            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('errors', $this->validator->getErrors());

        }

        //$validData = $this->validator->getValidated();

        /*echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;*/

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'Basic Information updated successfully.');
        } else {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Failed to update applicant information.');
        }
    }

}
