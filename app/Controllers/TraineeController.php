<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;
use App\Models\BankModel;
use App\Models\DesignationModel;
use App\Models\FcpsPartOneModel;
use App\Models\HonorariumSlotModel;
use App\Models\InstituteModel;
use App\Models\MbbsInstituteModel;
use App\Models\ProgressReportModel;
use App\Models\SpecialityModel;
use App\Models\SupervisorModel;
use App\Models\TrainingCategoryModel;

class TraineeController extends BaseController
{
    protected $trainingInstituteModel;
    protected $mbbsInstituteModel;
    protected $specialityModel;
    protected $designationModel;
    protected $progressReportModel;
    protected $supervisorModel;
    protected $fcpsPartOneModel;
    protected $applicantInformationModel;
    protected $honorariumSlotModel;
    protected $bankModel;
    protected $trainingCategoryModel;
    protected $db;

    public function __construct()
    {
        $this->trainingInstituteModel    = new InstituteModel();
        $this->mbbsInstituteModel        = new MbbsInstituteModel();
        $this->specialityModel           = new SpecialityModel();
        $this->designationModel          = new DesignationModel();
        $this->progressReportModel       = new ProgressReportModel();
        $this->supervisorModel           = new SupervisorModel();
        $this->fcpsPartOneModel          = new FcpsPartOneModel();
        $this->applicantInformationModel = new ApplicantInformationModel();
        $this->bankModel                 = new BankModel();
        $this->honorariumSlotModel       = new HonorariumSlotModel();
        $this->trainingCategoryModel     = new TrainingCategoryModel();
        $this->db                        = \Config\Database::connect();
    }

    public function trainees()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/index', $data);

    }

    public function traineeBasicInfo()
    {
        // Check if the authenticated user has the 'trainee.basic.info' permission
        if (!auth()->user()->can('trainee.basic.info')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        $data['basicInfo'] = $this->fcpsPartOneModel->getPartOneTraineeByRegNo(auth()->user()->username);

        return view('Trainee/basic-info', $data);

    }

    public function getSupervisorsByInstitute($instituteId)
    {
        $data = $this->supervisorModel->where('institute_id', $instituteId)->findAll();

        return $this->response->setJSON($data);
    }

    public function createProgressReport()
    {
        // Check if the authenticated user has the 'trainee.progress.reports.create' permission
        if (!auth()->user()->can('trainee.progress.reports.create')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $departments          = $this->specialityModel->where('status', true)->findAll();
        $data['departments']  = $departments;
        $data['specialities'] = $departments;
        $designations         = $this->designationModel->where('status', true)->findAll();
        $data['designations'] = $designations;

        return view('Trainee/trainings', $data);

    }

    public function storeProgressReport()
    {
        // Check if the authenticated user has the 'trainee.progress.reports.create' permission
        if (!auth()->user()->can('trainee.progress.reports.create')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');
        $validation = service('validation');

        $rules = [
            'instituteName'         => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must choose a Institute.',
                ],
            ],
            'departmentName'        => [
                'label' => 'Department',
                'rules' => 'required',
            ],
            'beds'                  => 'required|is_natural_no_zero',
            'trainees'              => 'required|is_natural',
            'facultyMembers'        => 'required|is_natural',
            'fromDate'              => 'required',
            'toDate'                => 'required',
            'supervisorName'        => 'required',
            'supervisorDesignation' => 'required',
            'supervisorMobile'      => 'required',
            'supervisorSubject'     => 'required',
            'attendance'            => 'required',
            'knowledge'             => 'required',
            'skill'                 => 'required',
            'attitude'              => 'required',
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return $this->createProgressReport();
        }

        // If you want to get the validated data.
        $validData = $this->validator->getValidated();

        //dd($validData);

        $model  = model(ProgressReportModel::class);
        $reg_no = auth()->user()->username;

        if ($this->request->getPost('supervisor') === '99999999') {
            $supervisorId = $this->supervisorModel->insert([
                'supervisor_name' => $validData['supervisorName'],
                'institute_id'    => $validData['instituteName'],
                'department_id'   => $validData['departmentName'],
                'designation_id'  => $validData['supervisorDesignation'],
                'subject_id'      => $validData['supervisorSubject'],
                'mobile'          => $validData['supervisorMobile'],
                'email'           => $this->request->getPost('supervisorEmail'),
                'mailing_address' => $this->request->getPost('supervisorAddress'),
            ]);
        } else {
            $supervisorId = $this->request->getPost('supervisor');
        }

        $successId = $model->insert([
            'reg_no'                   => $reg_no,
            'training_institute_id'    => $validData['instituteName'],
            'department_id'            => $validData['departmentName'],
            'no_of_beds'               => $validData['beds'],
            'no_of_trainees'           => $validData['trainees'],
            'no_of_faculty_mem'        => $validData['facultyMembers'],

            'training_start_date'      => $validData['fromDate'],
            'training_end_date'        => $validData['toDate'],
            'countable_duration_month' => 6,

            'supervisor_id'            => $supervisorId,
            //'supervisor_name'          => $validData['supervisorName'],
            //'designation_id'           => $validData['supervisorDesignation'],
            //'subject_id'               => $validData['supervisorSubject'],
            //'supervisor_mobile_no'     => $validData['supervisorMobile'],

            'attendance'               => $validData['attendance'],
            'knowledge'                => $validData['knowledge'],
            'skill'                    => $validData['skill'],
            'attitude'                 => $validData['attitude'],
        ]);

        if ($successId) {

            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Ohh! Something went wrong...!');
        }
    }

    public function showProgressReport($reportId)
    {
        $progressReportDetails = $this->progressReportModel->getProgressReportById($reportId);

        $data['progressReport'] = $progressReportDetails;

        return view('Trainee/view-report-details', $data);
    }

    public function editProgressReport($reportId)
    {
        echo 'Asif';
    }

    public function checkApplicationConstraints($regNo)
    {
        //Application already exists or not
        $checkTrainingApplication = $this->applicantInformationModel->checkBcpsRegiAlreadyUsed($regNo);
        if ($checkTrainingApplication) {
            $data['isError'] = true;
            $data['message'] = "You have already applied.";
            return $data;
        }

        $fcpsPartOneInfo = $this->fcpsPartOneModel->getPartOneTraineeByRegNo($regNo);
        //dd($fcpsPartOneInfo);

        //Applicant is passed before 2020
        if ($fcpsPartOneInfo['fcps_part_one_year'] < 2020) {
            $data['isError'] = true;
            $data['message'] = 'You are not eligible for application due to the completion of your FCPS Part-I before 2020.';
            return $data;
        }

        //Check E-logbook candidates
        if ($fcpsPartOneInfo['fcps_part_one_year'] >= 2025) {

            $specialityCheck = $this->specialityModel
                ->where([
                    'speciality_id' => $fcpsPartOneInfo['subject_id'],
                    'elogbook'      => 'Y',
                ])
                ->countAllResults();

            if ($specialityCheck > 0) {
                $data['isError'] = true;
                $data['message'] = 'You are not eligible here for application. Go to e-Logbook for application.';
            }

            return $data;
        }

        $data['isError'] = false;
        $data['message'] = "";
        return $data;

    }

    public function trainingApplication()
    {
        // Check if the authenticated user has the 'trainee.training.application' permission
        if (!auth()->user()->can('trainee.training.application')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $mbbsInstitutes         = $this->mbbsInstituteModel->where('status', true)->findAll();
        $data['mbbsInstitutes'] = $mbbsInstitutes;

        $departments          = $this->specialityModel->where('status', true)->findAll();
        $data['departments']  = $departments;
        $data['specialities'] = $departments;
        $designations         = $this->designationModel->where('status', true)->findAll();
        $data['designations'] = $designations;

        $banks         = $this->bankModel->where('status', true)->findAll();
        $data['banks'] = $banks;

        $generalInfo = $this->fcpsPartOneModel->getPartOneTraineeByRegNo(auth()->user()->username);

        /*dd(auth()->user());
        echo auth()->user()->reg_no;
        dd($generalInfo);*/

        $res = $this->checkApplicationConstraints($generalInfo['reg_no']);

        if (!$res['isError']) {
            $data['response']    = $res;
            $data['generalInfo'] = $generalInfo;
        } else {
            $data['response'] = $res;
        }

        return view('Trainee/training-application', $data);
    }

    public function storeTrainingApplication()
    {
        // Check if the authenticated user has the 'trainee.training.application' permission
        if (!auth()->user()->can('trainee.training.application')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');
        $validation = service('validation');

        //dd($this->request->getPost());

        $rules = [
            'dob'         => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Date of birth can\'t be blank.',
                ],
            ],
            'nationality' => [
                'label' => 'Nationality',
                'rules' => 'required',
            ],
            'gender'      => 'required',
            'nationalID'  => [
                'label' => 'National ID',
                'rules' => 'required',
            ],
            'mobile'      => 'required',
            'email'       => 'required',

            /*'trainees'              => 'required|is_natural',
        'facultyMembers'        => 'required|is_natural',
        'fromDate'              => 'required',
        'toDate'                => 'required',
        'supervisorName'        => 'required',
        'supervisorDesignation' => 'required',
        'supervisorMobile'      => 'required',
        'supervisorSubject'     => 'required',
        'attendance'            => 'required',
        'knowledge'             => 'required',
        'skill'                 => 'required',
        'attitude'              => 'required',*/
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return $this->trainingApplication();
        }

        // If you want to get the validated data.
        $validData = $this->validator->getValidated();

        //dd($validData);

        $successId = 1;
        /*$successId = $model->insert([
        'reg_no'                   => $reg_no,
        'training_institute_id'    => $validData['instituteName'],
        'department_id'            => $validData['departmentName'],
        'no_of_beds'               => $validData['beds'],
        'no_of_trainees'           => $validData['trainees'],
        'no_of_faculty_mem'        => $validData['facultyMembers'],

        'training_start_date'      => $validData['fromDate'],
        'training_end_date'        => $validData['toDate'],
        'countable_duration_month' => 6,

        'supervisor_id'            => $supervisorId,
        //'supervisor_name'          => $validData['supervisorName'],
        //'designation_id'           => $validData['supervisorDesignation'],
        //'subject_id'               => $validData['supervisorSubject'],
        //'supervisor_mobile_no'     => $validData['supervisorMobile'],

        'attendance'               => $validData['attendance'],
        'knowledge'                => $validData['knowledge'],
        'skill'                    => $validData['skill'],
        'attitude'                 => $validData['attitude'],
        ]);*/

        if ($successId) {

            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Ohh! Something went wrong...!');
        }

    }

    public function honorariumBillApplication()
    {
        // Check if the authenticated user has the 'trainee.honorarium.application' permission
        if (!auth()->user()->can('trainee.honorarium.application')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');

        $generalInfo = $this->fcpsPartOneModel->getPartOneTraineeByRegNo(auth()->user()->username);

        //dd($generalInfo);

        //echo auth()->user()->id;

        $checkTrainingApplication = $this->applicantInformationModel->checkBcpsRegiAlreadyUsed($generalInfo['reg_no']);

        if (!$checkTrainingApplication) {
            $data['applicationExists'] = false;
        } else {
            $data['applicationExists'] = true;
        }

        //dd($checkTrainingApplication);

        $trainingInstitutes = $this->trainingInstituteModel
            ->where('honorarium_status', true)
            ->where('status', true)
            ->orderBy('name', 'ASC')
            ->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $prevTrainingInstitutes = $this->trainingInstituteModel
            ->where('status', true)
            ->orderBy('name', 'ASC')
            ->findAll();
        $data['prevTrainingInstitutes'] = $prevTrainingInstitutes;

        $trainingCategories         = $this->trainingCategoryModel->findAll();
        $data['trainingCategories'] = $trainingCategories;

        $departments           = $this->specialityModel->where('status', true)->findAll();
        $data['departments']   = $departments;
        $data['specialities']  = $departments;
        $designations          = $this->designationModel->where('status', true)->findAll();
        $data['designations']  = $designations;
        $data['slots']         = $this->honorariumSlotModel->where('status', true)->findAll();
        $data['basicInfo']     = $generalInfo;
        $applicant             = $this->applicantInformationModel->getApplicantInfoByRegNo($generalInfo['reg_no']);
        $data['applicantInfo'] = $applicant;
        $data['banks']         = $this->bankModel->where('status', true)->findAll();

        //dd($applicant);

        $data['honorarium'] = array(
            'maxHonorariumCnt' => 0,
        );

        if ($applicant) {
            $sqlHonorarium = "select MAX(honorarium_position) AS maxHonorariumCnt
        from honorarium_information where eligible_status='Y' AND bmdc_reg_no='" . $applicant['bmdc_reg_no'] . "' AND applicant_id=" . $applicant['applicant_id'];

            $query              = $this->db->query($sqlHonorarium);
            $data['honorarium'] = $query->getRow();

            if ($data['honorarium']->maxHonorariumCnt == null) {
                $data['honorarium']->maxHonorariumCnt = 0;
            }
        }

        //dd($data['honorarium']);

        //dd($data['applicantInfo']);

        return view('Trainee/honorarium-application', $data);
    }

    public function storeBillApplication()
    {
        // Check if the authenticated user has the 'trainee.honorarium.application' permission
        if (!auth()->user()->can('trainee.honorarium.application')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        helper('form');
    }

}
