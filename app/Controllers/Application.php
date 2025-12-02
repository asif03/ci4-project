<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;
use App\Models\ApplicationAttachmentModel;
use App\Models\BankModel;
use App\Models\HonorariumInformationModel;
use App\Models\MbbsInstituteModel;
use App\Models\SpecialityModel;
use Dompdf\Dompdf;

class Application extends BaseController
{
    protected $applicationModel;
    protected $honorariumModel;
    protected $specialityModel;
    protected $mbbsInstituteModel;
    protected $bankModel;
    protected $applicationAttachmentModel;

    public function __construct()
    {
        $this->applicationModel           = new ApplicantInformationModel();
        $this->honorariumModel            = new HonorariumInformationModel();
        $this->specialityModel            = new SpecialityModel();
        $this->mbbsInstituteModel         = new MbbsInstituteModel();
        $this->bankModel                  = new BankModel();
        $this->applicationAttachmentModel = new ApplicationAttachmentModel;
    }

    public function index()
    {
        // Check if the authenticated user has the 'bills.index' permission
        if (!auth()->user()->can('applications.index')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to view list.');
        }

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

        $applicationInfo = $this->applicationModel->getApplicantById($id);

        if ($applicationInfo) {
            $currentTraininngInfo = $this->applicationModel->getCurrentTrainingInfoByApplicantId($id);
            $beforeTraininngInfo  = $this->applicationModel->getBeforeTrainingInfoByApplicantId($id);
            $choiceTraininngInfo  = $this->applicationModel->getChoiceTrainingInfoByApplicantId($id);
        }

        $applicantInfo = [
            'title'                  => 'Application',
            'applicationInfo'        => $applicationInfo,
            'currentTraininngInfo'   => $currentTraininngInfo,
            'beforeTraininngInfo'    => $beforeTraininngInfo,
            'choiceTraininngInfo'    => $choiceTraininngInfo,
            'applicationAttachments' => $this->applicationAttachmentModel
                ->where('applicant_id', $id)
                ->whereIn('type', $photographTypes)
                ->findAll(),
        ];

        /*echo '<pre>';
        print_r($applicantInfo);
        echo '</pre>';
        die;*/

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
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.approve')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            //return redirect()->to('/403')->with('error', 'You are not authorized to approve bills.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to approve applications.']);
        }

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
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.reject')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            //return redirect()->to('/403')->with('error', 'You are not authorized to approve bills.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to reject applications.']);
        }

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
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.edit')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to edit application.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to reject bills.']);
        }

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
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.basic.update')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to update Basic Information.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to update bills.']);
        }

        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        if (!$applicantId) {
            return redirect()->back()->with('error', 'Invalid applicant ID.');
        }

        // Update applicant information
        $data = [
            //'name'               => $request->getPost('name'),
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
            //'name' => 'required',
            'nid' => [
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
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.fcps.update')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to update FCPS Part-I Information.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to update bills.']);
        }

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

    public function updateMbbsInfo()
    {
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.mbbs.update')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to update MBBS Information.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to update bills.']);
        }

        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        if (!$applicantId) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Invalid applicant ID.');
        }

        // Update MBBS information
        $data = [
            'mbbs_institute_id' => $request->getPost('mbbsInstitute'),
            'mbbs_bds_year'     => $request->getPost('mbbsBdsYear'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => service('auth')->user()->id,
        ];

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'MBBS Information updated successfully.');
        } else {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Failed to update MBBS information.');
        }
    }

    public function updateBankInfo()
    {
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('applications.bank.update')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to update FCPS Part-I Information.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to update bills.']);
        }

        $request = service('request');

        $applicantId = $request->getPost('applicantId');

        if (!$applicantId) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Invalid applicant ID.');
        }

        $approvedHonorariums = $this->honorariumModel->getApprovedHonorariumByApplicantId($applicantId);
        if (count($approvedHonorariums) > 0) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Bank Information is not possible to update due to get honorarium before.');
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

    public function downloadApplicationForm($applicationId)
    {
        $photographTypes = ['photograph', 'signature'];

        $applicantBasicInfo = $this->applicationModel->getApplicantById($applicationId);

        if ($applicantBasicInfo) {
            $currentTraininngInfo = $this->applicationModel->getCurrentTrainingInfoByApplicantId($applicationId);
            $beforeTraininngInfo  = $this->applicationModel->getBeforeTrainingInfoByApplicantId($applicationId);
            $choiceTraininngInfo  = $this->applicationModel->getChoiceTrainingInfoByApplicantId($applicationId);
        }

        $photo = $signature = null;

        $applicantAttachments = $this->applicationAttachmentModel
            ->where('applicant_id', $applicationId)
            ->whereIn('type', $photographTypes)
            ->findAll();

        if (!empty($applicantAttachments)) {
            foreach ($applicantAttachments as $file) {
                if ($file['type'] === 'photograph') {
                    $photo = $file['file_name'];
                }
                if ($file['type'] === 'signature') {
                    $signature = $file['file_name'];
                }
            }

            $attachments = [
                'photograph' => $photo,
                'signature'  => $signature,
            ];
        } else {
            $attachments = [
                'photograph' => null,
                'signature'  => null,
            ];
        }

        $applicantInfo = [
            'application'            => $applicantBasicInfo,
            'currentTraininngInfo'   => $currentTraininngInfo,
            'beforeTraininngInfo'    => $beforeTraininngInfo,
            'choiceTraininngInfo'    => $choiceTraininngInfo,
            'applicationAttachments' => $attachments,
        ];

        //dd($applicantInfo);

        //return view('Application/pdf_form', $applicantInfo);

        if ($applicantInfo) {
            $dompdf = new Dompdf();
            $html   = view('Application/pdf_form', $applicantInfo);
            $dompdf->setOptions(new \Dompdf\Options(['isRemoteEnabled' => true]));
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('application_' . $applicantInfo['application']['bmdc_reg_no'] . $applicationId . '.pdf', ['Attachment' => true]);

        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Honorarium not found.']);
        }
    }

}
