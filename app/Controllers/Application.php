<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;
use App\Models\ApplicationAttachmentModel;
use App\Models\BankModel;
use App\Models\MbbsInstituteModel;
use App\Models\SpecialityModel;

class Application extends BaseController
{
    protected $applicationModel;
    protected $specialityModel;
    protected $mbbsInstituteModel;
    protected $bankModel;
    protected $applicationAttachmentModel;

    public function __construct()
    {
        $this->applicationModel           = new ApplicantInformationModel();
        $this->specialityModel            = new SpecialityModel();
        $this->mbbsInstituteModel         = new MbbsInstituteModel();
        $this->bankModel                  = new BankModel();
        $this->applicationAttachmentModel = new ApplicationAttachmentModel;
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

    public function getApplication($id)
    {
        $photographTypes = ['photograph', 'signature'];

        $applicantInfo = [
            'title'                  => 'Application',
            'applicationInfo'        => 'View Application Information',
            'trainingInfo'           => 'Training Information',
            'applicationAttachments' => $this->applicationAttachmentModel
                ->where('applicant_id', $id)
                ->whereIn('type', $photographTypes)
                ->findAll(),

        ];

        echo '<pre>';
        print_r($applicantInfo);
        echo '</pre>';
        //die;

        return view('Application/view', ['data' => $applicantInfo]);
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
            'banks'          => $this->bankModel->where('status', true)->findAll(),
        ];

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

    public function updateFcpsInfo()
    {
        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        if (!$applicantId) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Invalid applicant ID.');
        }

        // Update FCPS information
        $data = [
            'fcps_reg_no' => $request->getPost('bcpsRegNo'),
            'fcps_roll'   => $request->getPost('fcpcRollNo'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'updated_by'  => service('auth')->user()->id,
        ];

        if (!$this->validateData($data, [
            'fcps_reg_no' => [
                'label'  => 'NID',
                'rules'  => 'required|exact_length[10]',
                'errors' => [
                    'required'     => 'Online Registration No. is required.',
                    'exact_length' => 'Online Registration No. must be 10 digits in length.',
                ],
            ],
        ])) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('errors', $this->validator->getErrors());
        }

        $isValidRegNo = $this->applicationModel->checkBcpsRegNo($request->getPost('bcpsRegNo'));

        if (!$isValidRegNo) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Online Registration No. is not valid.');
        }

        $checkAlreadyExists = $this->applicationModel->checkBcpsRegiAlreadyUsed($request->getPost('bcpsRegNo'));
        if ($checkAlreadyExists) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Online Registration No. is already used by another applicant.');
        }

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'FCPS Information updated successfully.');
        } else {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Failed to update FCPS information.');
        }
    }

    public function updateBankInfo()
    {
        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        if (!$applicantId) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Invalid applicant ID.');
        }

        // Update Bank information
        $data = [
            'bank_id'        => $request->getPost('bankName'),
            'branch_name'    => $request->getPost('branchName'),
            'account_no'     => $request->getPost('acno'),
            'routing_number' => $request->getPost('routingNumber'),
            'updated_at'     => date('Y-m-d H:i:s'),
            'updated_by'     => service('auth')->user()->id,
        ];

        if (!$this->validateData($data, [
            'bank_id'        => [
                'label'  => 'Bank Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Bank Name is required.',
                ],
            ],
            'branch_name'    => [
                'label'  => 'Branch Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Branch Name is required.',
                ],
            ],
            'account_no'     => [
                'label'  => 'Account No.',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Account No. is required.',
                ],
            ],
            'routing_number' => [
                'label'  => 'Routing Number',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Routing Number is required.',
                ],
            ],
        ])) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('errors', $this->validator->getErrors());
        }

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'Bank Information updated successfully.');
        } else {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Failed to update Bank information.');
        }
    }

}
