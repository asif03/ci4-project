<?php

namespace App\Controllers;

use App\Models\ApplicantInformationModel;
use App\Models\DesignationModel;
use App\Models\FcpsPartOneModel;
use App\Models\InstituteModel;
use App\Models\ProgressReportModel;
use App\Models\SpecialityModel;
use App\Models\SupervisorModel;

class TraineeController extends BaseController
{
    protected $trainingInstituteModel;
    protected $specialityModel;
    protected $designationModel;
    protected $progressReportModel;
    protected $supervisorModel;
    protected $fcpsPartOneModel;
    protected $applicantInformationModel;

    public function __construct()
    {
        $this->trainingInstituteModel    = new InstituteModel();
        $this->specialityModel           = new SpecialityModel();
        $this->designationModel          = new DesignationModel();
        $this->progressReportModel       = new ProgressReportModel();
        $this->supervisorModel           = new SupervisorModel();
        $this->fcpsPartOneModel          = new FcpsPartOneModel();
        $this->applicantInformationModel = new ApplicantInformationModel();
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
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('unauthorized', 'You are not authorized to access this page!');
            $data['unauthorized'] = array(
                'status'  => true,
                'message' => 'You are not authorized to access this page!',
            );

        } else {
            $data['basicInfo'] = $this->fcpsPartOneModel->getPartOneTraineeById(auth()->user()->id);
        }

        //dd($data);

        return view('Trainee/basic-info', $data);

    }

    public function getSupervisorsByInstitute($instituteId)
    {
        $data = $this->supervisorModel->where('institute_id', $instituteId)->findAll();

        return $this->response->setJSON($data);
    }

    public function createProgressReport()
    {
        helper('form');

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $departments          = $this->specialityModel->where('status', true)->findAll();
        $data['departments']  = $departments;
        $data['specialities'] = $departments;
        $designations         = $this->designationModel->where('status', true)->findAll();
        $data['designations'] = $designations;

        //dd($departments);

        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/trainings', $data);

    }

    public function storeProgressReport()
    {
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

        $fcpsPartOneInfo = $this->fcpsPartOneModel->getPartOneTraineeById(auth()->user()->id);
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
        helper('form');

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $departments          = $this->specialityModel->where('status', true)->findAll();
        $data['departments']  = $departments;
        $data['specialities'] = $departments;
        $designations         = $this->designationModel->where('status', true)->findAll();
        $data['designations'] = $designations;

        $generalInfo = $this->fcpsPartOneModel->getPartOneTraineeById(auth()->user()->id);
        //dd($generalInfo);

        $res = $this->checkApplicationConstraints($generalInfo['reg_no']);

        if (!$res['isError']) {
            $data['response']    = $res;
            $data['generalInfo'] = $generalInfo;
        } else {
            $data['response'] = $res;
        }

        return view('Trainee/training-application', $data);
    }

    public function honorariumBillApplication()
    {
        helper('form');

        $generalInfo = $this->fcpsPartOneModel->getPartOneTraineeById(auth()->user()->id);

        //echo auth()->user()->id;

        $checkTrainingApplication = $this->applicantInformationModel->checkBcpsRegiAlreadyUsed($generalInfo['reg_no']);

        if (!$checkTrainingApplication) {
            $data['applicationExists'] = false;
        } else {
            $data['applicationExists'] = true;
        }

        //dd($checkTrainingApplication);

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $departments          = $this->specialityModel->where('status', true)->findAll();
        $data['departments']  = $departments;
        $data['specialities'] = $departments;
        $designations         = $this->designationModel->where('status', true)->findAll();
        $data['designations'] = $designations;

        //dd($departments);

        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/honorarium-application', $data);
    }

    public function storeBillApplication()
    {

    }

}
